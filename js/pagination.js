class Pagination {

    constructor(options) {
        this.items_per_page = options.items_per_page;
        this.num_numbers_page = options.num_numbers_page / 2;
        this.data = options.data;
        this.total_items = this.data.length;
        this.total_pages = Math.ceil(this.total_items / this.items_per_page);
        /*this.all_data = [...this.data];
        this.filter_data = [];*/

    }

    /*searchPatient(keysearch) {
        var searh_id = parseInt(keysearch);
        this.filter_data = this.all_data.filter(patients => {
            return (patients.name.toLowerCase().includes(keysearch.toLowerCase()) ||
            patients.email.toLowerCase().includes(keysearch.toLowerCase()) ||
            patients.phone.toLowerCase().includes(keysearch.toLowerCase()) ||
            patients.dni.toLowerCase().includes(keysearch.toLowerCase()) ||
            patients.id == searh_id);
        });

        this.total_items = this.filter_data.length;
        this.total_pages = Math.ceil(this.total_items / this.items_per_page);

        this.showPage(1);
    }


    search(keysearch) {
        this.filter_data = this.all_data.filter(product => {
            return (product.reference.toLowerCase().includes(keysearch.toLowerCase()) ||
            product.category.toLowerCase().includes(keysearch.toLowerCase()));
        });

        this.total_items = this.filter_data.length;
        this.total_pages = Math.ceil(this.total_items / this.items_per_page);

        this.showPageProducts(1);
    }

    searchFilter(categories, orders) {
        let products_filter = [...this.all_data];
    
        if (categories.length > 0) {
            products_filter = products_filter.filter(product => categories.includes(product.category));
        }
    

        if (orders.length > 0) {
            switch (orders[orders.length - 1]) {
                case 'popularidad':
                    //no se puede por popularidad
                    break;
                case 'ultimos':
                    //no se puede por ultimos
                    break;
                case 'precioBajo':
                    products_filter.sort((a, b) => a.price - b.price);
                    break;
                case 'precioAlto':
                    products_filter.sort((a, b) => b.price - a.price);
                    break;
                default:
            }
        }
    
        this.filter_data = products_filter;
        this.total_items = this.filter_data.length;
        this.total_pages = Math.ceil(this.total_items / this.items_per_page);
        $('#categories').css("display","none");
        this.showPageProducts(1);
    }
    

    generatePaginatorProducts(current_page) {
        let paginator_html = '';

        if (current_page > 1) {
            paginator_html += `<a href="#" class="page-link">&lt;</a>`;
        }

        if (current_page > this.num_numbers_page + 1) {
            paginator_html += `<span class="page-link-points">...</span>`;
        }

        for (let i = Math.max(1, current_page - this.num_numbers_page); i <= Math.min(this.total_pages, current_page + this.num_numbers_page); i++) {
            if (i === current_page) {
                paginator_html += `<span class="page-link active">${i}</span>`;
            } else {
                paginator_html += `<a href="#" class="page-link">${i}</a>`;
            }
        }

        if (current_page < this.total_pages - this.num_numbers_page) {
            paginator_html += `<span class="page-link-points">...</span>`;
        }

        if (current_page < this.total_pages) {
            paginator_html += `<a href="#" class="page-link">&gt;</a>`;
        }

        $('#paginator').html(paginator_html);

        $('#paginator .page-link').click((e) => {
            e.preventDefault();
            const target_page = $(e.target).text();
            if (target_page === "<" && current_page > 1) {
                this.showPageProducts(current_page - 1);
            } else if (target_page === ">" && current_page < this.total_pages) {
                this.showPageProducts(current_page + 1);
            } else if (!isNaN(target_page)) {
                this.showPageProducts(parseInt(target_page));
            }
        });
    }

    showPageProducts(page_number) {
        let result_products;
        if (this.filter_data.length > 0) {
            result_products = this.filter_data;
        } else {
            result_products = this.data;
        }

        const startIndex = (page_number - 1) * this.items_per_page;
        const endIndex = startIndex + this.items_per_page;
        const current_pageData = result_products.slice(startIndex, endIndex);
        const product_elements = current_pageData.map((product, index) => {
            const product_img = product.img[0] ? product.img[0].id : '';            
            return `<div class="products">
                        <a class="products-img" href="/productos/${product.id}" title="Producto ${product.reference}"> 
                            <img class="products-img" src=".${this.path}${product_img}_${product.id}-normal.webp" width="100%" alt="Productos recomendados">
                        </a>
                        <div class="products-texts">
                            <a class="product-title" href="/productos/${product.id}" title="Producto ${product.reference}">
                                ${product.reference}
                            </a>
                            <div class="product-text">
                                ${product.description_short}
                            </div>
                            <div class="product-sku">
                                SKU: <span class="product-result">${product.sku}</span>
                            </div>
                            <div class="product-sku">
                                Categoría: <span class="product-result">${product.category}</span>
                            </div>
                            <div class="product-final">
                                <a class="button-blue button-product" href="javascript:Cart.getDataProduct(${product.id})" title="Productos recomendados">Añadir al carrito
                                    <icon class="arrow-right"><img src="./assets/img/resources/arrow-right.svg" alt=""></icon>
                                </a>
                                <div class="product-price">${Bender.Tools.getPriceDecimalCurrency(product.price,product.rate)}</div>
                            </div>
                        </div>
                    </div>`;
        }).join('');
        $('#products-pagination').html(product_elements);
        $('.product-show').html(`Mostrando ${result_products.length} resultados`);
        this.generatePaginatorProducts(page_number);
    }*/



    generatePaginator(current_page) {
        let paginator_html = '';

        if (current_page > 1) {
            paginator_html += `<a href="#" class="page-link">&lt;</a>`;
        }

        if (current_page > this.num_numbers_page + 1) {
            paginator_html += `<span class="page-link-points">...</span>`;
        }

        for (let i = Math.max(1, current_page - this.num_numbers_page); i <= Math.min(this.total_pages, current_page + this.num_numbers_page); i++) {
            if (i === current_page) {
                paginator_html += `<span class="page-link active">${i}</span>`;
            } else {
                paginator_html += `<a href="#" class="page-link">${i}</a>`;
            }
        }

        if (current_page < this.total_pages - this.num_numbers_page) {
            paginator_html += `<span class="page-link-points">...</span>`;
        }

        if (current_page < this.total_pages) {
            paginator_html += `<a href="#" class="page-link">&gt;</a>`;
        }

        $('#paginator').html(paginator_html);

        $('#paginator .page-link').click((e) => {
            e.preventDefault();
            const target_page = $(e.target).text();
            if (target_page === "<" && current_page > 1) {
                this.showPage(current_page - 1);
            } else if (target_page === ">" && current_page < this.total_pages) {
                this.showPage(current_page + 1);
            } else if (!isNaN(target_page)) {
                this.showPage(parseInt(target_page));
            }
        });
    }

    showPage(page_number) {
        let result_events;
        /*if (this.filter_data.length > 0) {
            result_events = this.filter_data;

        } else {*/
            result_events = this.data;
        //}
        const startIndex = (page_number - 1) * this.items_per_page;
        const endIndex = startIndex + this.items_per_page;
        const current_pageData = result_events.slice(startIndex, endIndex);
        const events_elements = current_pageData.map((eventos, index) => 
            `<div class="evento-container">
            
                <div class="event-img">
                    <img src="">
                </div>

                <div class="bloque">

                    <div class="texts">
                        <div class="event-titulo">${eventos.nombre}</div>
                        <div class="sitio">
                            <img class="ubicacion" src="../img/iconos/ubicacion.png" alt="">
                            Castellon
                        </div>
                        <div class="fecha">
                            <img class="calendario" src="../img/iconos/calendario.png" alt="">
                            ${eventos.fecha}
                        </div>
                        <div class="precio"> Precio ${eventos.precio}€</div>
                    </div>

                    <div class="buttons">
                        <div class="button-event">
                            <a class="button-event-cat" href="tipo_evento.php?estilo=${eventos.estilo}">${eventos.estilo}</a>
                        </div>
                        <div class="button-categoria">
                            <a class="button-event-red" href="ev_nombre.php?id_evento=${eventos.id}">Quiero ir</a>
                        </div>
                    </div>

                </div>

            </div>`).join('');
        $('#eventos').html(events_elements);
        this.generatePaginator(page_number);
    }




}


export { Pagination }
