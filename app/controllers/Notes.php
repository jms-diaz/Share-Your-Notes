<?php

class Notes extends Controller
{
    public function __construct()
    {
        if (!isLoggedIn()) {
            redirect('users/login');
        }
        $this->userModel = $this->model('User');
        $this->noteModel = $this->model('Note');
    }

    public function index()
    {
        $notes = $this->noteModel->getNote();
        $data = [
            'notes' => $notes
        ];
        $this->view('notes/index', $data);
    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'title' => trim($_POST['title']),
                'body' => trim($_POST['body']),
                'user_id' => $_SESSION['user_id'],
                'title_error' => '',
                'body_error' => ''
            ];

            $title = $data['title'];
            $body = $data['body'];

            $data['title_error'] = $this->verifyTitle($title);
            $data['body_error'] = $this->verifyBody($body);

            if (empty($data['title_error']) && empty($data['body_error'])) {
                if ($this->noteModel->addNote($data)) {
                    flash('note_message', 'Note has been added!');
                    redirect('notes');
                } else {
                    die('Something went wrong');
                }
            } else {
                $this->view('notes/add', $data);
            }
        } else {
            $data = [
                'title' => '',
                'body' => ''
            ];
        }

        $this->view('notes/add', $data);
    }

    public function edit($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'id' => $id,
                'title' => trim($_POST['title']),
                'body' => trim($_POST['body']),
                'user_id' => $_SESSION['user_id'],
                'title_error' => '',
                'body_error' => ''
            ];

            $title = $data['title'];
            $body = $data['body'];

            $data['title_error'] = $this->verifyTitle($title);
            $data['body_error'] = $this->verifyBody($body);

            if (empty($data['title_error']) && empty($data['body_error'])) {
                if ($this->noteModel->updateNote($data)) {
                    flash('note_message', 'Note has been updated!');
                    redirect('notes');
                } else {
                    die('Something went wrong');
                }
            } else {
                $this->view('notes/edit', $data);
            }
        } else {

            $post = $this->noteModel->getNoteById($id);
            if ($post->user_id != $_SESSION['user_id']) {
                redirect('notes');
            }
            $data = [
                'id' => $id,
                'title' => $post->title,
                'body' => $post->body
            ];
        }

        $this->view('notes/edit', $data);
    }

    public function show($id)
    {
        $note = $this->noteModel->getNoteById($id);
        $user = $this->userModel->getUserById($note->user_id);
        $data = [
            'note' => $note,
            'user' => $user
        ];
        $this->view('notes/show', $data);
    }

    public function delete($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $post = $this->noteModel->getNoteById($id);
            if ($post->user_id != $_SESSION['user_id']) {
                redirect('notes');
            }
            if ($this->noteModel->deleteNote($id)) {
                flash('note_message', 'Note removed');
                redirect('notes');
            } else {
                die('Something went wrong');
            }
        } else {
            redirect('notes');
        }
    }

    public function verifyTitle($title)
    {
        if (empty($title)) {
            return 'Please enter title';
        }
    }

    public function verifyBody($body)
    {
        if (empty($body)) {
            return 'Please enter text';
        }
    }
}
