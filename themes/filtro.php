<div class="container-fluid filtro">
    <div class="row-12 img-filtro">
        <div class="filtro">
            <h1 class="my-4" id="title-filtro">Buscar eventos</h1>
            <form class="filtro-form" method="post" action="">
                <div class="form-group" id="buscador">
                    <input type="text" class="form-control" id="nombre" name="nombre" style="border-radius: 5px 0px 0px 5px"
                         value="<?php echo $nombre ?>" placeholder="Buscar eventos por nombre, artistas, ciudad..." />
                </div>

                <div class="form-group">
                <select class="form-control dropdown" id="fecha" name="fecha">
                        <option value="">Todas las fechas</option>
                        <option value="dia" <?php if ($fecha === "dia") echo "selected";?>>Hoy</option>
                        <option value="semana" <?php if ($fecha === "semana") echo "selected";?>>Esta semana</option>
                        <option value="mes" <?php if ($fecha === "mes") echo "selected";?>>Este mes</option>
                        <option value="trimestre" <?php if ($fecha === "trimestre") echo "selected";?> >Este trimestre</option>
                    </select>
                </div>

                <div class="form-group">
                    <select class="form-control dropdown" id="estilo" name="estilo">
                        <option value="">Todos los estilos musicales</option>
                        <option value="regueton"  <?php if ($estilo === "regueton") echo "selected";?>>Reguetón</option>
                        <option value="urban" <?php if ($estilo === "urban") echo "selected";?>>Urban</option>
                        <option value="indie" <?php if ($estilo === "indie") echo "selected";?>>Indie</option>
                        <option value="pop" <?php if ($estilo === "pop") echo "selected";?>>Pop</option>
                        <option value="electronica" <?php if ($estilo === "electronica") echo "selected";?>>Electrónica</option>
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
