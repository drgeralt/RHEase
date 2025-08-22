<?php

require_once BASE_PATH . '/app/Models/ApplicationModel.php';

class JobController {

    public function show_job() {
        // Esses dados normalmente seriam recuperados do banco de dados
        $title = 'Engenheiro de Software';
        $description = 'Estamos buscando um engenheiro de software habilidoso para nossa equipe.';
        $responsibilities = [
            'Escrever código de alta qualidade.',
            'Testar aplicativos.',
            'Participar de reuniões de equipe.'
        ];

        require_once BASE_PATH . '/app/Views/job_details_and_form.php';
    }

    public function store_application() {
        $applicationModel = new ApplicationModel();
        $success = $applicationModel->saveApplication($_POST);

        if ($success) {
            header('Location: /Rhease/public/thank_you.php');
        } else {
            header('Location: /Rhease/public/error.php');
        }
        exit;
    }

    public function show_applications() {
        $applicationModel = new ApplicationModel();
        $applications = $applicationModel->getApplications();
        require_once BASE_PATH . '/app/Views/applications.php';
    }

    public function show_bio($id){
        $applicationModel = new ApplicationModel();
        $application = $applicationModel->getApplicationById($id);
        require_once BASE_PATH . '/app/Views/bio.php';
    }

    public function show_update_form($id) {
        $applicationModel = new ApplicationModel();
        $application = $applicationModel->getApplicationById($id);

        if (!$application) {
            header('Location: /Rhease/public/error');
            exit;
        }

        require_once BASE_PATH . '/app/Views/update_application.php';
    }

    public function process_update($id) {
        $applicationModel = new ApplicationModel();
        $success = $applicationModel->updateApplicationById($id, $_POST);

        if ($success) {
            header('Location: /Rhease/public/applications');
        } else {
            header('Location: /Rhease/public/error');
        }
        exit;
    }

    public function delete_application($id) {
        $applicationModel = new ApplicationModel();
        $success = $applicationModel->deleteApplicationById($id);

        if ($success) {
            header('Location: /Rhease/public/applications');
        } else {
            header('Location: /Rhease/public/error');
        }
        exit;
    }
}
