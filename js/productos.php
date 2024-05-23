<!DOCTYPE html>
<html lang="es">
<?php include 'head.php';
$products = $bender->getProductsImages();
$categories = $bender->getCategory();
//print_r($products);
?>
</head>

<body class="<?php echo $base ?>">

    <div class="page">
        <?php include 'loader.php'; ?>
        <?php include 'header.php'; ?>
        <?php include 'bread-crumb.php'; ?>

        <div class="products-element">
            <div class="prodcuts-title">Productos</div>
        </div>

        <div class="products-description">
            <h1 class="description-text">Última tecnología especializada en la calidad del sueño.</h1>
            <div class="description-img"><img src="./assets/img/quienes-somos/objetive.webp" alt="" width='100%'></div>
        </div>

        <div class="block-products">
            <div class="prodcuts-block-filter">
                <div class="block-elements">
                    <div class="product-filter" id="filter-toggle"><img src="./assets/img/filtro.svg" width="100%" alt="">filtro</div>


                    <div class="categories-container" id="categories">
                        <div class="filter-categories">
                            <div class="filter-list">
                                <div class="filter-category-name" data-category="all">Seleccionar categorías:</div>
                                <div class="block-filter">
                                    <?php foreach ($categories as $category) {
                                        $name_category = $category["referencia"];
                                        $name_encode = json_encode($name_category);
                                        echo "<label class='filter-category'><input type='checkbox'  value='$name_encode' onclick='toggleCategory(this)' />$name_category</label>";
                                    } ?>
                                </div>
                            </div>
                            <div class="filter-linea"></div>
                            <div class="filter-list">
                                <div class="filter-category-name" data-category="all">Ordenar por:</div>
                                <div class="block-filter">
                                    <!--<label class="filter-category-orden"><input class="product-check" type="checkbox" value="popularidad" onclick="orderBy('popularidad')" />Popularidad</label>
                                    <label class="filter-category-orden"><input class="product-check" type="checkbox" value="ultimos" onclick="orderBy('ultimos')" />Últimos publicados</label>-->
                                    <label class="filter-category-orden"><input class="product-check" type="checkbox" value="precioBajo" onclick="orderBy('precioBajo')" />Precio: bajo a alto</label>
                                    <label class="filter-category-orden"><input class="product-check" type="checkbox" value="precioAlto" onclick="orderBy('precioAlto')" />Precio: alto a bajo</label>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="product-show"></div>
                    <input type="search" class="search-product" id="keysearch" name="nombre" placeholder="Buscar por nombre o categoría">

                </div>
            </div>
            <div class="first-products" id="products-pagination"></div>
            <div class="patient-page" id="paginator"></div>
        </div>

    </div>
    <?php include 'footer.php'; ?>


    <script>
        var user_data = <?php print_r($data_user); ?>;
        var dominio = "<?php echo $dominio; ?>";
        var Bender;
        var Pagination;
        var Cart;
        var path_products = "<?php echo $bender->path_products;  ?>";
        var products = <?php echo json_encode($products);  ?>;
    </script>

    <script type="module">
        import {
            Bender3D
        } from "./assets/js/3dbender/3dbender.js";
        Bender = new Bender3D(user_data);
        Pagination = Bender.getNewPagination({
            "items_per_page": 20,
            "data": products,
            "num_numbers_page": 4,
            "path": path_products
        });
        window.Bender = Bender;
        window.Pagination = Pagination;
        Cart = Bender.getNewCart();
        window.Cart = Cart;
        Pagination.showPageProducts(1);

        $("#filter-toggle").click(function() {
            $("#categories").toggle();
        });
    </script>

    <script>
        $("#keysearch").keyup(function(event) {
            if (event.key === "Enter") {
                event.preventDefault();
                var keysearch = $('#keysearch').val();
                Pagination.search(keysearch);
            }
        });

        $('.product-check').on('change', function(event) {
            event.stopPropagation();
            if ($(this).prop('checked')) {
                $('.product-check').not(this).prop('checked', false);
            }
        });

        let select_category = [];
        let select_order = {};

        function toggleCategory(checkbox) {
            const category = JSON.parse(checkbox.value);
            if (checkbox.checked) {
                select_category.push(category);
            } else {
                const index = select_category.indexOf(category);
                if (index !== -1) {
                    select_category.splice(index, 1);
                }
            }

            if (select_category.length === 0) {
                $('.product-check').prop('checked', false);
                select_order = {};
            }
            Pagination.searchFilter(select_category, Object.values(select_order));
        }

        function orderBy(order) {

            if (select_order[order]) {
                select_order[order] = !select_order[order];
            } else {
                select_order = {};
                select_order[order] = true;
            }

            if (Object.keys(select_order).length === 0) {
                $('.product-check').prop('checked', false);
            }

            Pagination.searchFilter(select_category, Object.keys(select_order).filter(key => select_order[key]));
        }
    </script>


</body>

</HTML>
