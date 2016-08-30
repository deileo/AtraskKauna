set :application, "Kas Vyksta Kaune."
set :domain,      "www.projektai.nfqakademija.lt"
set :deploy_to,   "/home/kaunas2/public_html"
set :app_path,    "app"
set :user, "kaunas2"

set :repository,  "git@github.com:nfq-akademija-2015-ruduo/Kas_vyksta_Kaune.git"
set :scm,         :git
set   :use_composer,     true
set   :use_composer_tmp, true

set :shared_files,      ["app/config/parameters.yml"]

ssh_options[:port] = "22129"
ssh_options[:forward_agent] = true
set :model_manager, "doctrine"
# Or: `propel`
set  :deploy_via, :capifony_copy_local
role :web,        domain                         # Your HTTP server, Apache/etc
role :app,        domain, :primary => true       # This may be the same as your `Web` server

set  :use_sudo,      false
set  :keep_releases,  3

# Be more verbose by uncommenting the following line
logger.level = Logger::MAX_LEVEL