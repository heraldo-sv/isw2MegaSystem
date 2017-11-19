<div class="modal fade bs-example-modal-lg" id="dtlimage">
    <div class="modal-dialog" style="width: fit-content;max-width: 1500px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
                <h4>Galería de imagenes</h4>
            </div>
            <div class="modal-body">
                <div id="myCarousel" class="carousel slide" data-ride="carousel">
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                        <li data-target="#myCarousel" id="carousel_li_active" data-slide-to="0" class="active"></li>
                        <li data-target="#myCarousel" class="carousel-it-active" v-for="(dtlImage, index) in dtlImages" :data-slide-to="index+1"></li>
                    </ol>
                    <!-- Wrapper for slides -->
                    <div class="carousel-inner">
                        <div id="carousel_di_active" class="item active">
                            <img src="../imagenes/proyectos/nota_confidencial.png" alt="Nota confidencial">
                        </div>
                        <div class="item carousel-it-active" v-for="(dtlImage, index) in dtlImages">
                            <img :src="dtlImage.ruta" :alt="dtlImage.nombre">
                        </div>
                    </div>
                <!-- Left and right controls -->
                <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#myCarousel" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                    <span class="sr-only">Next</span>
                </a>
                </div>
            </div>
        </div>
    </div>
</div>