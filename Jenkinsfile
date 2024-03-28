pipeline {
    agent any

    environment {
        WORK_DIR = 'C:\\Users\\Luc\\Documents\\hanze-ICT\\Ontwikkelstraten\\itvb23ows-starter-code'
    }

    stages {
        stage('SCM') {
            steps {
                git branch: 'main', url: 'https://github.com/jajajaja234/itvb23ows-starter-code.git'
            }
        }

        stage('SonarQube analysis') {
            steps {
                script {
                    def scannerHome = tool 'hive-sonarqube'
                    withSonarQubeEnv('hive-sonar') {
                                        bat "${scannerHome}/bin/sonar-scanner -Dsonar.projectKey=hive"
                    }
                }
            }
        }

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
                    bat 'php HiveGame/Tests/wintest.php' 
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
