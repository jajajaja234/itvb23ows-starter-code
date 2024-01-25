pipeline {
    agent any

    environment {
        // Definieer de locatie eenmaal bovenaan de pipeline
        WORK_DIR = 'C:\\Users\\Luc\\Documents\\hanze-ICT\\Ontwikkelstraten\\itvb23ows-starter-code'
    }

    stages {
        stage('Build') {
            steps {
                echo 'Building the PHP application'
                dir(WORK_DIR) {
                    bat 'docker-compose build'
                    // Voeg hier stappen toe om je applicatie te bouwen (bijvoorbeeld composer install)
                }
            }
        }

        stage('Test') {
            steps {
                echo 'Running tests'
                dir(WORK_DIR) {
                    bat 'php --version'
                    // Voeg hier stappen toe om je tests uit te voeren (bijvoorbeeld phpunit)
                }
            }
        }

        stage('Deploy') {
            steps {
                echo 'Deploying the PHP application'
                dir(WORK_DIR) {
                    bat 'docker-compose up -d'
                    // Voeg hier stappen toe om je applicatie te implementeren (bijvoorbeeld Docker build en push)
                }
            }
        }
    }

    post {
        always {
            // Opruimen na de pipeline is voltooid
            script {
                dir(WORK_DIR) {
                    bat 'docker-compose down'
                }
            }
        }
    }
}

