pipeline {
    agent any

    stages {
        stage('Get Code') {
            steps {
                git branch: 'main', url: 'https://github.com/jajajaja234/itvb23ows-starter-code.git'
            }
        }

        stage('Build and Analyze') {
            steps {
                script {
                    // Voer hier de buildstappen uit

                    // Voer SonarQube-analyse uit met de SonarQube Scanner-plug-in
                    withSonarQubeEnv('hive-sonar') {
                        // In plaats van 'sonar-scanner' gebruiken we 'withSonarQube' blok
                        // voor het uitvoeren van de SonarQube-analyse
                    }
                }
            }
        }
    }
}
