<div class="container-fluid filtro">
    <div class="row-12 img-filtro">
        <div class="filtro">
            <h1 class="my-4" id="title-filtro">Buscar eventos</h1>
            <form class="filtro-form">
                <div class="form-group" id="buscador">
                    <input type="text" class="form-control" id="nombre" name="nombre" style="border-radius: 5px 0px 0px 5px" placeholder="Buscar eventos por nombre, artistas, ciudad..." />
                </div>

                <div class="form-group">
                    <select class="form-control dropdown" id="fecha" name="fecha">
                        <option value="">Todas las fechas</option>
                        <option value="dia">Hoy</option>
                        <option value="semana">Esta semana</option>
                        <option value="mes">Este mes</option>
                        <option value="trimestre">Este trimestre</option>
                    </select>
                </div>

                <div class="form-group">
                    <select class="form-control dropdown" id="estilo" name="estilo">
                        <option value="">Todos los estilos musicales</option>
                        <option value="regueton">Reguetón</option>
                        <option value="urban">Urban</option>
                        <option value="indie">Indie</option>
                        <option value="pop">Pop</option>
                        <option value="electronica">Electrónica</option>
                        <option value="techno">Techno</option>
                    </select>
                </div>
                <div class="form-group">
                    <button type="submit" id="button-filtro" class="form-control" style="border-radius: 0px 5px 5px 0px">
                        Filtrar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
