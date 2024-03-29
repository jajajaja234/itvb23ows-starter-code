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
                }
            }
        }

        stage('Test') {
            steps {
                echo 'Running tests'
                dir(WORK_DIR) {
                    bat 'php --version'
                    //bat 'php HiveGame/Tests/DropdownTest.php'
                    bat 'php HiveGame/Tests/IsQueenPlaced.php' 
                    //bat 'php HiveGame/Tests/MovinPiecesTest.php' 
                    //bat 'php HiveGame/Tests/PassTest.php' 
                    //bat 'php HiveGame/Tests/QueenMoveTest.php' 
                    //bat 'php HiveGame/Tests/WinTest.php' 
                }
            }
        }

        stage('Deploy') {
            steps {
                echo 'Deploying the PHP application'
                dir(WORK_DIR) {
                    bat 'docker-compose up -d'
                }
            }
        }
    }

    post {
        always {
            script {
                dir(WORK_DIR) {
                    bat 'docker-compose down'
                }
            }
        }
    }
}
