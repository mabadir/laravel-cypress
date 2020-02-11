<?php

namespace Mabadir\LaravelCypress\Console\Commands;

use Illuminate\Console\Command;

class AddCypressCommands extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cypress:publish';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add Cypress commands to the commands.js file';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $commands = <<<EOD
Cypress.Commands.add("create", (model, overrides={}) => {
        return cy.request(`/__testing__/create/\${model}`, overrides).its("body");
});

Cypress.Commands.add("multiCreate", (model, count, overrides={}) => {
        return cy.request(`/__testing__/create/\${model}/\${count}`, overrides).its("body");
});

Cypress.Commands.add("migrate", () => {
        return cy.request(`/__testing__/migrate`);
});

Cypress.Commands.add("login", (model="User", overrides={}) => {
        return cy.request(`/__testing__/login/\${model}`, overrides).its("body");
});
EOD;
        $file = fopen(base_path("cypress/support/commands.js"),'a+');
        fwrite($file, $commands);
    }
}
