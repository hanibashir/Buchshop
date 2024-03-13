<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\Book;
use Framework\Exceptions\PageNotFoundException;
use Framework\Response;

class Books extends Controller
{
    public function __construct(private readonly Book $model)
    {
    }

    public function index(): Response
    {

        $products = $this->model->findAll();

        return $this->view("Books/index.bbq.php", [
            "books" => $products
        ]);
    }

    public function create(): Response
    {
        if ($this->request->post) {
            $data = [
                "name" => $this->request->post["name"],
                "description" => empty($this->request->post["description"]) ? null : $this->request->post["description"]
            ];
            if ($this->model->insert($data)) {
                return $this->redirect("/books/{$this->model->getInsertedID()}/show");
            } else {

                return $this->view("Books/create.bbq.php", [
                    "errors" => $this->model->getErrors(),
                    "book" => $data
                ]);
            }

        } else { // GET request
            return $this->view("Books/create.bbq.php");
        }
    }

    public function show(string $id): Response
    {
        $product = $this->get($id);

        return $this->view("Books/show.bbq.php", [
            "book" => $product
        ]);

    }

    public function edit(string $id): Response
    {
        $product = $this->get($id);
        if ($this->request->post) {

            $product["name"] = $this->request->post["name"];
            $product["description"] = empty($this->request->post["description"]) ? null : $this->request->post["description"];
            if ($this->model->update($id, $product)) {
                return $this->redirect("/books/{$id}/show");
            } else {

                return $this->view("Books/edit.bbq.php", [
                    "errors" => $this->model->getErrors(),
                    "book" => $product
                ]);
            }

        } else { // GET request

            return $this->view("Books/edit.bbq.php", [
                "book" => $product
            ]);
        }

    }

    public function delete(string $id): Response
    {
        $product = $this->get($id);

        if ($this->request->server["REQUEST_METHOD"] === "POST") {

            if ($this->model->delete($id)) {
                return $this->redirect("/books");
            } else {
                return $this->view("Products/delete.bbq.php", [
                    "errors" => $this->model->getErrors(),
                    "book" => $product
                ]);
            }

        } else {
            return $this->view("Books/delete.bbq.php", [
                "product" => $product
            ]);
        }

    }

    private function get(string $id): bool|array
    {
        $product = $this->model->find($id);
        if (!$product) {
            throw new PageNotFoundException("Model is not available!");
        }

        return $product;
    }

}