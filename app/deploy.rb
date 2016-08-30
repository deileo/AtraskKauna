set :application, 'atraskkauna'
set :repo_url, '#'

set :deploy_to, '/home/atraskkauna/'

set :branch, 'master'
set :scm, :archive

set :linked_files, fetch(:linked_files, []).push('.env')
set :linked_dirs, fetch(:linked_dirs, []).push('storage/logs')

