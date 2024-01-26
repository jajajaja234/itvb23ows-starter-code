pipeline {
    agent any

    stages {

        stage('Scan'){
            steps {
                withSonarQubeEnv(installationName: 'hive-sonar') {
                }
            }
        }      
    }
}

