pipeline {
    agent any

    environment {
        SCANNER_HOME = tool 'Sonar'  // Assurez-vous que l'outil 'Sonar' est configuré dans Jenkins
    }

    stages {
        stage('Preparation') {
            steps {
                script {
                    // Installer les dépendances PHP via Composer
                    sh 'composer install'
                }
            }
        }

        stage('SonarQube Analysis') {
            steps {
                script {
                    // Exécuter l'analyse avec SonarQube Scanner
                    withSonarQubeEnv('SonarQube') {  // Nom du serveur SonarQube configuré dans Jenkins
                        sh "${SCANNER_HOME}/bin/sonar-scanner -Dsonar.projectKey=testBackend -Dsonar.sources=. -Dsonar.host.url=http://172.17.0.2:9000 -Dsonar.login=sqp_0e85b1f9e872edf4c5961f8ce0e0f9693aae8a0e"
                    }
                }
            }
        }

        stage('Quality Gate') {
            steps {
                script {
                    // Attendre et vérifier le résultat du Quality Gate de SonarQube
                    timeout(time: 1, unit: 'HOURS') {
                        waitForQualityGate abortPipeline: true
                    }
                }
            }
        }
    }

    post {
        always {
            // Nettoyer l'espace de travail après chaque build
            cleanWs()
        }
        success {
            echo 'Build succeeded!'
        }
        failure {
            echo 'Build failed!'
        }
    }
}
