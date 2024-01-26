pipeline {
    agent any

    stages {
        stage('SCM') {
            git 'https://github.com/jajajaja234/itvb23ows-starter-code.git'
        }

        tage('SonarQube analysis') {
            def scannerHome = tool 'SonarScanner 4.0';
            withSonarQubeEnv('hive-sonar') { // If you have configured more than one global server connection, you can specify its name
            sh "${scannerHome}/bin/sonar-scanner"
            }
        }
    }
}

