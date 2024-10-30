 
<?php

require_once 'app/models/Applicant.php';

class ApplicantsController {
    private $applicantModel;

    public function __construct($pdo) {
        $this->applicantModel = new Applicant($pdo);
    }

    public function handleRequest($data) {
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'GET':
                if (isset($data['id'])) {
                    $applicant = $this->applicantModel->read($data['id']);
                    echo json_encode($applicant);
                } else {
                    $applicants = $this->applicantModel->getAll();
                    echo json_encode($applicants);
                }
                break;

            case 'POST':
                $this->applicantModel->create($data['name'], $data['email'], $data['phone_number']);
                http_response_code(201);
                break;

            case 'PUT':
                if (isset($data['id'])) {
                    $this->applicantModel->update($data['id'], $data['name'], $data['email'], $data['phone_number']);
                    echo json_encode(['message' => 'Updated successfully']);
                }
                break;

            case 'DELETE':
                if (isset($data['id'])) {
                    $this->applicantModel->delete($data['id']);
                    http_response_code(204);
                }
                break;

            default:
                http_response_code(405);
                break;
        }
    }
}
