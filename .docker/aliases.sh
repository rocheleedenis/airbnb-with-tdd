# aliases.sh
alias gc="git checkout"
alias grr="git reset --soft HEAD~1"
alias art="php artisan"
alias test="composer test"
alias testf="composer test --filter"

# functions
make_model() {
    local model_name=$1
    php artisan make:model "$model_name" -m -f --test
}