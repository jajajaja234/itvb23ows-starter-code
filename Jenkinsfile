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
            // Voer hier de stappen uit om je project te bouwen
            // Bijvoorbeeld: bat 'mvn clean install'

            // Ga naar de Jenkins-workspace
            dir("${WORKSPACE}") {
                // Voer SonarQube-scanner uit
                withSonarQubeEnv('hive-sonar') {
                    echo "Running SonarQube analysis..."
                    bat "sonar-scanner"
                    }   
                }
            }
        }
    }
}
}

