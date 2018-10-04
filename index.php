<html>
    <head>
        <title>Academia Testarii Metup</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <header>
            <div class="top_bar">
                <i class="fa fa-phone" style="margin: 10px;"></i> 0799.005.004 sau 0734.540.913
                <ul class="pull-right text-end social-icons clearfix">
                    <li><a href="https://www.facebook.com/academiatestarii/" title="Facebook" target="_blank" rel="noopener"><i class="fab fa-facebook-f"></i></a></li><li><a href="https://www.linkedin.com/company/18151104/" title="LinkedIn" target="_blank" rel="noopener"><i class="fab fa-linkedin-in"></i></a></li>
                </ul>
            </div>
            <nav class="navbar navbar-light">
                <span class="navbar-brand mb-0 h1">
                    <img height="111" src="http://academiatestarii.ro/wp/wp-content/uploads/2017/11/Logo-color-RGB.png" alt="">
                </span>
            </nav>
        </header>
        <div class="container">
            <div id="failed" class="row">
                <div class="col">
                    <h2> Ne pare rau, comanda dumneavostra nu a putut fi procesata. Incercati din nou.</h2>
                    <button id="reload" class="btn btn-primary mx-auto" style="width: 200px;display: block">Incearca din nou</button>
                </div>
            </div>
            <div id="success" class="row">
                <div class="col">
                    <h3><i class="fas fa-users"></i> Rezumat Comanda</h3>
                    <table id="cart-final" class="table table-hover table-condensed">
                        <thead>
                        <tr>
                            <th style="width:20%">Product</th>
                            <th style="width:20%">Price</th>
                            <th style="width:18%">Quantity</th>
                            <th style="width:22%" class="text-center">Subtotal</th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                        <tfoot>
                        <tr>
                            <td class="hidden"><a href="#" class="btn btn-warning hidden-xl" style="visibility: hidden"><i class="fa fa-angle-left"></i> Continue Shopping</a></td>
                            <td colspan="2">Discount <span id="final-discount"></span>%</td>
                            <td class="hidden-xs text-center"><strong>Total <span id="final-total"></span>$</strong></td>
                        </tr>
                        </tfoot>
                    </table>
                    <button id="reload" class="btn btn-primary mx-auto" style="width: 200px;display: block">Comanda din nou</button>
                </div>
            </div>
            <div id="step-1" class="row">
                <div class="col-8">
                    <form id="personal_form">
                        <h3><i class="fas fa-users"></i> Informatii Personale</h3>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="nume">Nume</label>
                                    <input type="text" class="form-control" id="nume" placeholder="Nume">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <label for="varsta">Varsta</label>
                                    <input type="text" class="form-control" id="varsta" placeholder="Varsta">
                                </div>
                                <div class="form-group">
                                    <label for="studii">Studii Absolvite</label>
                                    <input type="text" class="form-control" id="studii" placeholder="Studii Absolvite">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group" style="margin-left:-30px;">
                                    <label for="prenume">Prenume</label>
                                    <input type="text" class="form-control" id="prenume" placeholder="Prenume">
                                </div>
                                <div class="form-group">
                                    <label for="telefon">Telefon</label>
                                    <input type="text" class="form-control" id="telefon" placeholder="Telefon">
                                </div>
                                <div class="form-group">
                                    <label for="localitate">Localitate</label>
                                    <input type="text" class="form-control" id="localitate" placeholder="Localitate">
                                </div>
                                <div class="form-group">
                                    <label for="judet">Judet</label>
                                    <input type="text" class="form-control" id="judet" placeholder="Judet">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <button id="submit-personal" class="btn btn-primary mx-auto" style="width: 200px;display: block">Continua cumparaturiile</button>
                            </div>
                        </div>
                    </form>
                    <form id="shop-form">
                        <h3><i class="fas fa-shopping-bag"></i> Produse</h3>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="categorie">Categorie</label>
                                    <select class="form-control" id="categorie">
                                        <option value="1">Categoria 1</option>
                                        <option value="2">Categoria 2</option>
                                        <option value="3">Categoria 3</option>
                                        <option value="4">Categoria 4</option>
                                        <option value="5">Categoria 5</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="disponobil">Cantitate Disponibila</label>
                                    <input type="text" class="form-control" id="disponobil" readonly>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="produs">Produs</label>
                                    <select class="form-control" id="produs">
                                        <option value="1">Produs 1</option>
                                        <option value="2">Produs 2</option>
                                        <option value="3">Produs 3</option>
                                        <option value="4">Produs 4</option>
                                        <option value="5">Produs 5</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="pret">Pret</label>
                                    <input type="text" class="form-control" id="pret" readonly>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="cantitate">Cantitate</label>
                                    <input type="text" class="form-control" id="cantitate" placeholder="Cantitate">
                                </div>
                                <div class="form-group">
                                    <button type="submit" id="adauga" class="btn btn-primary mx-auto" style="margin-top:48px;width: 200px;display: block"><i class="fas fa-plus"></i> Adauga in cos</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-4">
                    <h3 class="right"><i class="fas fa-cart-plus"></i> Shopping Cart</h3>
                    <div id="cart-content">
                        <table id="cart" class="table table-hover table-condensed">
                            <thead>
                            <tr>
                                <th style="width:20%">Product</th>
                                <th style="width:20%">Price</th>
                                <th style="width:18%">Quantity</th>
                                <th style="width:22%" class="text-center">Subtotal</th>
                                <th style="width:20%"></th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                            <tfoot>
                            <tr>
                                <td class="hidden"><a href="#" class="btn btn-warning hidden-xl" style="visibility: hidden"><i class="fa fa-angle-left"></i> Continue Shopping</a></td>
                                <td colspan="2">Discount <span id="discount"></span>%</td>
                                <td class="hidden-xs text-center"><strong >Total <span id="total"></span>$</strong></td>
                                <td><a href="#" id="checkout" class="btn btn-success btn-block">Checkout <i class="fa fa-angle-right"></i></a></td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

        </div>
        <script   src="https://code.jquery.com/jquery-3.3.1.min.js"   integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="   crossorigin="anonymous"></script>
        <script src="scripts.js" type="text/javascript"></script>
    </body>
</html>