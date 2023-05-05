<?php

class MailServerController
{
    private $hmailserver;
    private $authenticated;
    private $domain;

    public function __construct()
    {
        $this->hmailserver = new COM("hMailServer.Application");
        $this->authenticated = $this->hmailserver->Authenticate("Administrator", "rootpass");
        if (!$this->authenticated) {
            die("Mail server authentication failed.");
        }
        $this->domain = $this->hmailserver->Domains->ItemByDNSName("mimail.org");
    }

    public function registerUser($username, $password)
    {
        $account = $this->domain->Accounts->Add();
        $account->Address = $username . "@" . "mimail.org";
        $account->Password = $password;
        $account->Save();

        return true;
    }
}
