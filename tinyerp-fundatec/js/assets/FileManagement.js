/* 
 * Archivo JS que administra los archivos para guardarlos o eliminarlos en BD.
 */

$(document).ready(function () {
    //se ejecuta el inicializador
    fileManagement.fnInitializer();
});

var fileManagement = {

    fnInitializer: function () {
        /*
         * Inicializa los componentes necesarios
         */

        //se inicializa el componente dropzone a utilizado
        fileManagement.fnInitFileUpload();
    },

    fnControlsId: {
        /*
         * Contiene los nombres de los controles utilizados en este archivo
         */
        fileUpload: "#fileUpload",
        hddFileName: "#hddFileName",
        hddFileType: "#hddFileType",
        btnDownload: "#btnDownload",
    },

    fnInitFileUpload: function () {
        /*
         * Inicializa el comonente dropfile a utilizar
         */

        Dropzone.options.fileUpload = {
            maxFiles: 1,
            init: function () {
                //funcion se ejecuta cuando se a exedido la cantidad de archivos permitidos
                this.on("maxfilesexceeded", function (file) {
                    //solo se permite un archivo, si se elige otro se elimina el anterior
                    this.removeAllFiles();
                    this.addFile(file);
                });

                //funcion se ejecuta cuadno el archivo fue agregado
                this.on("addedfile", function (file) {
                    //obtenemos la informacion del archivo cargado
                    $(fileManagement.fnControlsId.hddFileName).val(file.name);
                    $(fileManagement.fnControlsId.hddFileType).val(file.type);
                });
            }
        };
    },

    fnDownloadFile(fileName, fileType) {
        /*
         * Asigna el href al boton de descarga para descargar el archivo
         */

        $(fileManagement.fnControlsId.btnDownload).removeClass('hidden');
        $(fileManagement.fnControlsId.btnDownload).attr('href', "download.php?file=" + fileName + "&type=" + fileType);
    }

}
