<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\Book;
use Framework\Exceptions\PageNotFoundException;

class Books extends Controller
{
    public function __construct(private readonly Book $model)
    {
    }

    public function index(): void
    {

        $books = $this->model->findAll();

        echo $this->viewer->render("Books/index.mvc.php", [
            "books" => $books
        ]);

    }

    public function create(): void
    {
        if ($this->request->post) {
            $data = [
                "name" => $this->request->post["name"],
                "description" => empty($this->request->post["description"]) ? null : $this->request->post["description"]
            ];
            if ($this->model->insert($data)) {
                header("Location: /products/{$this->model->getInsertedID()}/show");
                exit;
            } else {

                echo $this->viewer->render("Products/create.mvc.php", [
                    "errors" => $this->model->getErrors(),
                    "product" => $data
                ]);
            }

        } else { // GET request
            echo $this->viewer->render("Products/create.mvc.php");
        }
    }

    public function show(string $id): void
    {
        $product = $this->get($id);

        echo $this->viewer->render("Products/show.mvc.php", [
            "product" => $product
        ]);

    }

    public function edit(string $id): void
    {
        $product = $this->get($id);
        if ($this->request->post) {

            $product["name"] = $this->request->post["name"];
            $product["description"] = empty($this->request->post["description"]) ? null : $this->request->post["description"];
            if ($this->model->update($id, $product)) {
                header("Location: /products/{$id}/show");
                exit;
            } else {

                echo $this->viewer->render("Products/edit.mvc.php", [
                    "errors" => $this->model->getErrors(),
                    "product" => $product
                ]);
            }

        } else { // GET request

            echo $this->viewer->render("Products/edit.mvc.php", [
                "product" => $product
            ]);
        }

    }

    public function delete(string $id): void
    {
        $product = $this->get($id);

        if ($this->request->server["REQUEST_METHOD"] === "POST") {

            if ($this->model->delete($id)) {
                header("Location: /products");
                exit;
            } else {
                echo $this->viewer->render("Products/delete.mvc.php", [
                    "errors" => $this->model->getErrors(),
                    "product" => $product
                ]);
            }

        } else {
            echo $this->viewer->render("Products/delete.mvc.php", [
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