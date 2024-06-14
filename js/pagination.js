class Pagination {

    constructor(options) {
        this.items_per_page = options.items_per_page;
        this.num_numbers_page = options.num_numbers_page / 2;
        this.data = options.data;
        this.total_items = this.data.length;
        this.total_pages = Math.ceil(this.total_items / this.items_per_page);
    }

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
        result_events = this.data;
        const startIndex = (page_number - 1) * this.items_per_page;
        const endIndex = startIndex + this.items_per_page;
        const current_pageData = result_events.slice(startIndex, endIndex);
        const events_elements = current_pageData.map((eventos, index) =>
            `<div class="evento-container">
                <div class="event-img">
                    <img class="img-event-fijo" src="${eventos.url}">
                </div>
                <div class="bloque">
                    <div class="eventos-block">
                        <div class="event-titulo">${eventos.nombre}</div>
                        <div class="texts">
                            <div class="sitio">
                                <img class="ubicacion" src="../img/iconos/ubicacion.png" alt="">
                                ${eventos.provincia}
                            </div>
                            <div class="fecha">
                                <img class="calendario" src="../img/iconos/calendario.png" alt="">
                                ${eventos.fecha}
                            </div>
                            <div class="precio"> Precio ${eventos.precio}€</div>
                        </div>
                    </div>
                    <div class="buttons">
                        <div class="button-event">
                            <a class="button-event-cat" href="home.php?estilo=${eventos.estilo}">${eventos.estilo}</a>
                        </div>
                        <div class="button-categoria">
                            <a class="button-event-red" href="ev_nombre.php?id_evento=${eventos.id}">Ver</a>
                        </div>
                    </div>
                </div>
            </div>`).join('');
        $('#eventos').html(events_elements);
        this.generatePaginator(page_number);
    }
}
export { Pagination }
