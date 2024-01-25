pipeline {
    agent any

    stages {
        stage('Build') {
            steps {
                script {
                    // Use the Docker image with PHP and Apache
                    docker.image('php:7.4-apache').inside('-u root') {
                        // Install required dependencies
                        sh 'apt-get update -y && apt-get install -y libmariadb-dev'

                        // Build the PHP application
                        sh 'docker-php-ext-install mysqli pdo pdo_mysql'
                        sh 'chmod -R 755 /var/www/html'
                    }
                }
            }
        }

        stage('Test') {
            steps {
                script {
                    // Run your tests here
                    // You may need to adjust this based on your testing framework
                    // For example: sh 'phpunit'
                }
            }
        }

        stage('Deploy') {
            steps {
                script {
                    // Deploy your application here
                    // You may need to copy files, restart services, etc.
                    // For example: sh 'docker-compose up -d'
                }
            }
        }
    }
}

