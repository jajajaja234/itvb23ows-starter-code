pipeline {
    agent any

    stages {
        stage('SCM') {
            steps {
            git branch: 'main', url: 'https://github.com/jajajaja234/itvb23ows-starter-code.git'
        } }

        stage('SonarQube analysis') {
            steps {
            def scannerHome = tool 'SonarScanner 4.0';
            withSonarQubeEnv('hive-sonar') { // If you have configured more than one global server connection, you can specify its name
            bat "${scannerHome}/bin/sonar-scanner"
            }}
        }
    }
}