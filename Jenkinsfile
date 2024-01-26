pipeline{
    agent any
    environment {
        PATH = "$PATH:C:/Program Files/apache-maven-3.9.6/bin"
    }
    stages{
       stage('GetCode'){
            steps{
                git branch: 'main', url: 'https://github.com/jajajaja234/itvb23ows-starter-code.git'
            }
         }        
       stage('Build'){
            steps{
        bat '"C:/Program Files/apache-maven-3.9.6/bin/mvn" clean package'
            }
        }

        stage('SonarQube analysis') {
//    def scannerHome = tool 'SonarScanner 4.0';
        steps{
        withSonarQubeEnv('hive-sonar') { 
        // If you have configured more than one global server connection, you can specify its name
//      sh "${scannerHome}/bin/sonar-scanner"
        bat "mvn sonar:sonar"
    }
        }
        }
       
    }
}
