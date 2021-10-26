pipeline {
    agent any
    stages {
		stage('start Build') {
            steps {
                echo 'Start Build' 
                echo 'Pulling...' +   env.GIT_BRANCH
            }
        }
        stage('Git Proses') {          
            steps {
				script {
                    if (env.GIT_BRANCH == 'origin/master') {
                         dir ('/var/www/html/plugins/interactive-generator') {
							sh('/bin/git pull origin master')
						}
                    } else {
                        echo 'branch development'
						
                    }
                }
            }
        }
		
       
    }
}
