pipeline {
    agent any

    stages {
        stage('Checkout') {
            steps {
                script {
                    // Checkout the code from GitHub
                    checkout([$class: 'GitSCM', branches: [[name: '*/main']], userRemoteConfigs: [[url: 'https://github.com/jajajaja234/itvb23ows-starter-code.git']]])
                }
            }
        }

        stage('Build') {
            steps {
                // Voeg hier eventuele buildstappen toe
            }
        }

        stage('SonarQube Analysis') {
            steps {
                script {
                    // Voer SonarQube-analyse uit
                    withSonarQubeEnv(installationName: 'hive-sonar') {
                        bat 'msbuild.exe /t:Rebuild'  // Voeg hier je build commando toe, bijv. msbuild
                        bat 'SonarScanner.MSBuild.exe begin /k:"project-key" /d:sonar.host.url="http://localhost:9000" /d:sonar.login="jenkins-pipeline"'
                        bat 'msbuild.exe /t:Rebuild'  // Voeg hier opnieuw je build commando toe
                        bat 'SonarScanner.MSBuild.exe end /d:sonar.login="jenkins-pipeline"'
                    }
                }
            }
        }

        // Voeg hier andere stappen toe zoals testen, deployment, etc.
    }
}
