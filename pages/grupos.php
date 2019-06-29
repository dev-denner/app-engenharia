<?php include "../common/header.php"; ?>

<div class="container">
    <h2 class="display-4 text-center">Grupos</h2>
    <div class="row">
        <div class="col">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>Grupo 1</td>
                            <td>
                                <a class="btn btn-sm btn-warning" href="#" role="button">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a class="btn btn-sm btn-danger" href="#" role="button">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-sm-1"></div>
        <div class="col">
            <form class="row">
                <div class="form-group col-sm-10">
                    <input type="hidden" name="id_grupo" value="" />
                    <label for="nome_grupo" class="sr-only">Nome:</label>
                    <input type="text" class="form-control" id="nome_grupo" name="nome_grupo" aria-describedby="nomeHelp" placeholder="Nome">
                    <small id="nomeHelp" class="form-text text-muted">Nome do grupo.</small>
                </div>
                <div class="form-group col-sm-2">
                    <button type="submit" class="btn btn-primary">Gravar</button>
                </div>
            </form>
        </div>
    </div>

</div>

<?php include "../common/footer.php"; ?>