$( document ).ready(function() {
    var productsInCart = [];
    var preturi = {
      1: [10, 20 , 30, 40 , 50],
      2: [20 , 30, 40 , 50, 60],
      3: [10 , 30, 50 , 70, 90],
      4: [10 , 12, 14 , 17, 18],
      5: [100 , 120, 140 , 160, 180]
    };
    var hasError = false;
    var discount = 0;
    var secretDiscount = 0;

    $("#pret").val(getCost());
    getCantitate();
    populateCart();
    function getCantitate()
    {
        var category = $("#categorie").val();
        var produs = $('#produs').val();

        $.ajax({
            method: "POST",
            url: "api.php",
            data: { categorie: category, produs: produs, post: 1 }
        })
            .done(function( msg ) {
                $("#disponobil").val(msg);
            });

    };

    function addToCart() {
        var product = createProduct();
        productsInCart.push(product);
        populateCart();
        $("#cantitate").val('');
    }

    function createProduct() {
        return {
            id: productsInCart.length + 1,
            nume: 'Produs ' + $('#produs').val(),
            categorie: $('#categorie').val(),
            produs: $('#produs').val(),
            pret: $('#pret').val(),
            cantitate: $('#cantitate').val(),
            subtotal: parseInt($('#cantitate').val()) * parseInt($('#pret').val())
        }
    }
    function populateCart() {
        $("#cart > tbody").html('');
        productsInCart.forEach(function(produs) {
            $( "#cart > tbody" ).append( "<tr>\n" +
                "                                <td data-th=\"Product\">\n" +
                "                                    <div class=\"row\">\n" +
                "                                        <div class=\"col-sm-12\">\n" +
                "                                            <h4 class=\"nomargin\">" + produs.nume + "</h4>\n" +
                "                                        </div>\n" +
                "                                    </div>\n" +
                "                                </td>\n" +
                "                                <td data-th=\"Price\">" + produs.pret + " $</td>\n" +
                "                                <td data-th=\"Quantity\">\n" +
                "                                    <input type=\"number\"  class=\"form-control quantity text-center\" data-id=" + produs.id + " value=" + produs.cantitate + ">\n" +
                "                                </td>\n" +
                "                                <td data-th=\"Subtotal\" class=\"text-center\">"+ produs.subtotal +" $</td>\n" +
                "                                <td class=\"actions\" data-th=\"\">\n" +
                "                                    <button class=\"btn btn-danger remove btn-sm\" data-id=" + produs.id + "><i class=\"fas fa-trash-alt\"></i></button>\n" +
                "                                </td>\n" +
                "                            </tr>" );

        });
        setDiscount();
        setTotal();
    }

    function populateFinalCart(){
        var count = 1;
        productsInCart.forEach(function(produs) {
            if(count % 2 == 0) {
                $( "#cart-final > tbody" ).append( "<tr>\n" +
                    "                                <td data-th=\"Product\">\n" +
                    "                                    <div class=\"row\">\n" +
                    "                                        <div class=\"col-sm-12\">\n" +
                    "                                            <h4 class=\"nomargin\">" + produs.nume + "</h4>\n" +
                    "                                        </div>\n" +
                    "                                    </div>\n" +
                    "                                </td>\n" +
                    "                                <td data-th=\"Price\">" + produs.pret + " $</td>\n" +
                    "                                <td data-th=\"Quantity\">\n" +
                    "                                    cant. " + produs.cantitate + "\n" +
                    "                                </td>\n" +
                    "                                <td data-th=\"Subtotal\" class=\"text-center\">"+ produs.subtotal +" $</td>\n" +
                    "                            </tr>" );
            }
            $( "#cart-final > tbody" ).append( "<tr>\n" +
                "                                <td data-th=\"Product\">\n" +
                "                                    <div class=\"row\">\n" +
                "                                        <div class=\"col-sm-12\">\n" +
                "                                            <h4 class=\"nomargin\">" + produs.nume + "</h4>\n" +
                "                                        </div>\n" +
                "                                    </div>\n" +
                "                                </td>\n" +
                "                                <td data-th=\"Price\">" + produs.pret + " $</td>\n" +
                "                                <td data-th=\"Quantity\">\n" +
                "                                    cant. " + produs.cantitate + "\n" +
                "                                </td>\n" +
                "                                <td data-th=\"Subtotal\" class=\"text-center\">"+ produs.subtotal +" $</td>\n" +
                "                            </tr>" );

            count++;
        });
        $("#final-discount").html(secretDiscount);
        setFinalTotal();
    }

    function setDiscount() {
        var varsta = $("#varsta").val();

        if(parseInt(varsta) < 56) {
            discount = 40;
        }
        if(parseInt(varsta) < 36) {
            discount = 30;
        }
        if(parseInt(varsta) < 26) {
            discount = 20;
        }
        secretDiscount = discount;

        if($("#studii").val() === '' || $("#telefon").val() === '') {
            secretDiscount = 0;
        }
        if($("#localitate").val() === 'Bucuresti' || $("#localitate").val() === 'Iasi' || $("#localitate").val() === 'Cluj') {
            secretDiscount = secretDiscount + 10;
        }

        $("#discount").html(discount);

    }

    function checkCombo(firstProduct, secondProduct) {
        var foundOne = false;
        var foundTwo = false;
        for(var i = 0; i < productsInCart.length; i++) {
            if (productsInCart[i].categorie == firstProduct.categorie && productsInCart[i].produs == firstProduct.produs) {
                foundOne = true;
            }
            if (productsInCart[i].categorie == secondProduct.categorie && productsInCart[i].produs == secondProduct.produs) {
                foundTwo = true;
            }
        }
        if(foundOne && foundTwo) {
            return true;
        } else {
            return false;
        }
    }

    function failedCombo() {
        var isCombo = false;
        if (checkCombo({categorie: 1, produs: 3}, {categorie: 2, produs: 1}) || checkCombo({categorie: 2, produs: 5}, {categorie: 3, produs: 5}) || checkCombo({categorie: 4, produs: 2}, {categorie: 5, produs: 2}) ) {
            isCombo = true;
        }
        return isCombo;
    }



    function checkout() {
        var totalQuantity = 0;
        var shouldFail = failedCombo();
        if (shouldFail) {
            $("#step-1").hide();
            $("#failed").show();
        } else {
            for (var i = 0; i < productsInCart.length; i++)
            {
                totalQuantity += productsInCart[i]['cantitate'];
            }

            if(totalQuantity > 3) {
                secretDiscount = secretDiscount + 5;
            }

            $.ajax({
                method: "POST",
                url: "api.php",
                data: { produse: productsInCart, discount: secretDiscount, post: 2 }
            })
                .done(function( msg ) {
                    msg = JSON.parse(msg);
                    $("#step-1").hide();
                    if(msg.success) {
                        $("#success").show();
                        populateFinalCart();
                    } else {
                        $("#failed").show();
                    }
                });
        }
    }
    function setTotal() {
        var total = 0;
        var hasError = false;
        for (var i = 0; i < productsInCart.length; i++)
        {
            if(!productsInCart[i]['subtotal']) {
                hasError = true;
            }
            total += productsInCart[i]['subtotal'];
        }
        total = total - (discount*total) / 100;
        if(hasError) {
            total = 1000;
        }
        $("#total").html(total);
    }

    function setFinalTotal() {
        var total = 0;
        var hasError = false;
        for (var i = 0; i < productsInCart.length; i++)
        {
            if(!productsInCart[i]['subtotal']) {
                hasError = true;
            }
            total += productsInCart[i]['subtotal'];
        }
        total = total - ((secretDiscount*total) / 100);
        if(hasError) {
            total = 1000;
        }
        $("#final-total").html(total);
    }
    function getCost(){
        var category = $("#categorie").val();
        var produs = $('#produs').val();
        return preturi[category][produs - 1];
    }

    function updateQuantity(id, value) {
        productsInCart = productsInCart.map(function(product) {
            if(product['id'] == id) {
                product['cantitate'] = value;
                product['subtotal'] = parseInt(value) * parseInt(product.pret);
            }
            return product
        });
        populateCart();
    }
    function removeProduct(id) {
        productsInCart = productsInCart.filter(function(el) { return parseInt(el.id) != id; });
        populateCart();
    }
    $('#cart').on('keyup', '.quantity', function () {
        var id = $(this).attr('data-id');
        updateQuantity(id, $(this).val());

    });

    $('#cart').on('click', '.remove', function () {
        var id = $(this).attr('data-id');
        removeProduct(id);
    });

    $("#adauga").on('click', function(){
        if($("#cantitate").val() == '' || parseInt($("#disponobil").val()) < -4 || parseInt($("#cantitate").val()) > 4 || parseInt($("#cantitate").val()) > parseInt($("#disponobil").val())) {
            $('#cantitate').addClass('has-error');
        } else {
            $('#cantitate').removeClass('has-error');
            addToCart();
        }
    });

    $( "#categorie, #produs" ).change(function() {
        $("#pret").val(getCost());
        getCantitate();
    });
    $("#checkout").on('click', function(){
        checkout();

    });
    $("#submit-personal").on('click', function(){
        hasError = false;
        if($("#nume").val() === ''){
           hasError = true;
           $('#nume').addClass('has-error');
       } else {
           $('#nume').removeClass('has-error');
       }
        if($("#prenume").val() === '' || $("#prenume").val().length > 14){
            hasError = true;
            $('#prenume').addClass('has-error');
        } else {
            $('#prenume').removeClass('has-error');
        }
        if($("#email").val() === ''){
            hasError = true;
            $('#email').addClass('has-error');
        } else {
            $('#email').removeClass('has-error');
        }
        if($("#varsta").val() === ''){
            hasError = true;
            $('#varsta').addClass('has-error');
        } else {
            $('#varsta').removeClass('has-error');
        }
        if($("#localitate").val() === ''){
            hasError = true;
            $('#localitate').addClass('has-error');
        } else {
            $('#localitate').removeClass('has-error');
        }
        if(!hasError) {
            $("#personal_form").hide();
            $("#shop-form").addClass('active');
        }
    });
    $("#personal_form").submit(function(e){
        e.preventDefault(e);
    });
    $("#shop-form").submit(function(e){
        e.preventDefault(e);
    });

    $(".reload").on('click', function(){
        window.location.reload();
    })
});