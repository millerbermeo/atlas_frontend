document.addEventListener('DOMContentLoaded', function () {
    const urlUsuarios = 'https://cartera.atlas.com.co/cobranza/php/api_all_users.php';
    const urlZonas = 'https://cartera.atlas.com.co/cobranza/php/api_user.php';
    const urlGraficos = 'https://cartera.atlas.com.co/cobranza/php/api_cartas.php';
    const urlCartera = 'https://cartera.atlas.com.co/cobranza/php/api_total_cartas.php';
    const urlGraficosDos = 'https://cartera.atlas.com.co/cobranza/php/api_empresas.php';
    const urlCobros = 'https://cartera.atlas.com.co/cobranza/php/api_cobro.php';

    let mostarDom = document.getElementById("section-mostar")

    let boton = document.getElementById("crearpdf");

    let nav2 = document.getElementById("accordionSidebar");


    boton.addEventListener("click", event => {
        event.preventDefault();
        boton.style.display = "none";
        nav2.style.display = "none";

        var css = '@page { size: 45cm 35.7cm; }',
            head = document.head || document.getElementsByTagName('head')[0],
            style = document.createElement('style');

        style.type = 'text/css';
        style.media = 'print';

        if (style.styleSheet) {
            style.styleSheet.cssText = css;
        } else {
            style.appendChild(document.createTextNode(css));
        }

        head.appendChild(style);
        window.print();
    }, false);




    var fecha_inicioGlobal;
    var fecha_finGlobal;
    var agenteGlobal;
    var zonaGlobal;

    var selectUsuarios = document.getElementById("miSelect");
    var selectZonas = document.getElementById("miSelect2");
    var tipoGraficoSelect = document.getElementById('tipoGrafico');
    var ctx = document.getElementById('myBarChart2').getContext('2d');
    var myBarChart2;

    selectUsuarios.addEventListener('change', function () {
        var selectedUsuario = selectUsuarios.value;
        selectZonas.innerHTML = '';

        const formData = new FormData();
        formData.append('id', selectedUsuario);

        fetch(urlZonas, {
            method: 'POST',
            body: formData
        })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`Error en la solicitud POST: ${response.statusText}`);
                }
                return response.json();
            })
            .then(data => {
                var zonasArray = data.zone.split(',');

                var todasOption = document.createElement("option");
                todasOption.value = "Todas";
                todasOption.textContent = "Todas";
                selectZonas.appendChild(todasOption);

                zonasArray.forEach(function (zona) {
                    var option = document.createElement("option");
                    option.value = zona.trim();
                    option.textContent = zona.trim();
                    selectZonas.appendChild(option);
                });

                console.log('Zonas:', zonasArray);
            })
            .catch(error => {
                console.error(error);
            });
    });

    fetch(urlUsuarios)
        .then(response => {
            if (!response.ok) {
                throw new Error(`Error en la solicitud: ${response.statusText}`);
            }
            return response.json();
        })
        .then(data => {
            var todosOption = document.createElement("option");
            todosOption.value = "Todos";
            todosOption.textContent = "Todos";
            selectUsuarios.appendChild(todosOption);

            data.forEach(function (usuario) {
                var option = document.createElement("option");
                option.value = usuario.id;
                option.textContent = usuario.agent_name;
                selectUsuarios.appendChild(option);
            });
        })
        .catch(error => {
            console.error('Error al obtener los datos de usuarios:', error);
        });

    document.getElementById('miFormulario').addEventListener('submit', function (event) {
        event.preventDefault();
        hacerPeticion();



        mostarDom.style.display = "block"


        let fecha_inicio = document.getElementById('fecha').value;
        let fecha_fin = document.getElementById('fecha2').value;
        let agente = document.getElementById('miSelect').value
        let zona = document.getElementById('miSelect2').value

        let agenteSelect = document.getElementById('miSelect')
        let agenteShow = agenteSelect.options[agenteSelect.selectedIndex].text;

        if (new Date(fecha_inicio) > new Date(fecha_fin)) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'La fecha de inicio no puede ser posterior a la fecha de fin.',
            });
            return false;
        }


        fecha_inicioGlobal = document.getElementById('mostrarFechaInicio').textContent = fecha_inicio;
        fecha_finGlobal = document.getElementById('mostrarFechaFin').textContent = fecha_fin;
        agenteGlobal = document.getElementById('mostrarAgente').textContent = agenteShow;
        zonaGlobal = document.getElementById('mostrarZona').textContent = zona;

        var formData2 = new FormData();

        //Casos que funcionan y me devuelve datos para renderizar

        formData2.append('id', agente); //aqui va el egente pero uso id = 2 por que es el unico caso que funciona
        formData2.append('zone', zonaGlobal); //zona todas
        formData2.append('fecha_ini', fecha_inicioGlobal); // 2023-10-01
        formData2.append('fecha_fin', fecha_finGlobal); //    2023-11-03




        //COBROS -------------------



        fetch(urlCobros, {
            method: 'POST',
            body: formData2
        })
            .then(response => response.json())
            .then(data => {


                console.log('cobros Respuesta del servidor:', data);
                // Puedes realizar acciones adicionales con los datos aquí
                document.getElementById("totalEmpresasCobro").innerHTML = data.total_empresas_cobro
                document.getElementById("totalCartera").innerHTML = data.total_cartera
                document.getElementById("avanceCobro").innerHTML = data.avance_cobro
                document.getElementById("clientesImpactados").innerHTML = data.clientes_impactados

            })
            .catch(error => {
                console.error('Error al realizar la solicitud:', error);
            });




        //COBRO0S--------------------






        fetch(urlGraficos, {
            method: 'POST',
            body: formData2
        })
            .then(response => response.json())
            .then(data => {

                if (data === null) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Los datos no procesados.',
                    });
                } else {
                    Swal.fire({
                        icon: 'success',
                        title: 'Éxito',
                        text: 'Los datos se han procesado con éxito.',
                    });
                }



                console.log('Respuesta del servidor:', data);

                const labels = data.map(item => item.tipo);
                const values = data.map(item => item.cantidad);

                console.log(labels);
                console.log(values);

                tipoGraficoSelect.addEventListener('change', function () {
                    let typegrafico = document.getElementById('tipoGrafico').value;
                    renderizarGrafico(labels, values, typegrafico);
                });

                // Renderizar el gráfico por defecto al cargar la página
                renderizarGrafico(labels, values, tipoGraficoSelect.value);
            })
            .catch(error => {
                console.error('Error al realizar la solicitud:', error);
            });




        //CARTERAS -----------------


        const container = document.getElementById('cartasPorUsuarioContainer');

        if (!container) {
            console.error('Error: El contenedor no fue encontrado en el DOM.');
            return;
        }
        // Realizar la solicitud POST
        fetch(urlCartera, {
            method: 'POST',
            body: formData2
        })
            .then(response => response.json())
            .then(data => {
                // Procesar los datos para sumar la cantidad por usuario y por tipo de letra
                const usuariosSuma = {};
                const tipoSuma = {};

                data.forEach(item => {
                    const usuario = item.usuario;
                    const cantidad = parseInt(item.cantidad_de_cartas);
                    const tipoCarta = item.tipo.charAt(0);

                    // Sumar por usuario
                    if (usuariosSuma[usuario] === undefined) {
                        usuariosSuma[usuario] = { total: cantidad, tipos: {} };
                    } else {
                        usuariosSuma[usuario].total += cantidad;
                    }

                    // Sumar por tipo de letra
                    if (usuariosSuma[usuario].tipos[tipoCarta] === undefined) {
                        usuariosSuma[usuario].tipos[tipoCarta] = cantidad;
                    } else {
                        usuariosSuma[usuario].tipos[tipoCarta] += cantidad;
                    }

                    // Sumar por tipo de letra global
                    if (tipoSuma[tipoCarta] === undefined) {
                        tipoSuma[tipoCarta] = cantidad;
                    } else {
                        tipoSuma[tipoCarta] += cantidad;
                    }
                });

                // Renderizar la información en el HTML
                let htmlContent = '';
                Object.entries(usuariosSuma).forEach(([usuario, datosUsuario]) => {
                    htmlContent += `
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between align-items-center">
                            <h6 class="m-0 font-weight-bold text-primary">CARTAS POR USUARIO:</h6>
                            <span class="">${usuario}</span>
                        </div>
                        <div class="card-body">
                            <h6 class="font-weight-bold"> <span class="float-left">Cartas: ${datosUsuario.total}</span></h6>
                            <div class="mb-4">
                            <br>
                                <ul>
                `;

                    Object.entries(datosUsuario.tipos).forEach(([tipo, cantidad]) => {
                        htmlContent += `<li>${tipo}: ${cantidad}</li>`;
                    });

                    htmlContent += `
                                </ul>
                            </div>
                        </div>
                    </div>
                `;
                });

                // Agregar sección para mostrar totales por tipo de letra global
                htmlContent += `
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex justify-content-between align-items-center">
                        <h6 class="m-0 font-weight-bold text-primary">TOTAL POR TIPO DE CARTA: </h6>
                    </div>
                    <div class="card-body">
                        <ul>
            `;

                Object.entries(tipoSuma).forEach(([tipo, cantidad]) => {
                    htmlContent += `<li>${tipo}: ${cantidad}</li>`;
                });

                htmlContent += `
                        </ul>
                    </div>
                </div>
            `;

                container.innerHTML = htmlContent;
            })
            .catch(error => {
                console.error('Error al realizar la solicitud: UNOOOOO', error);
            });







        // ULTIMA PETICION CON GRAFICOS

        async function hacerPeticion() {
            try {
                const response = await fetch(urlGraficosDos, {
                    method: 'POST',
                    body: formData2
                });

                if (!response.ok) {
                    throw new Error('Error en la solicitud');
                }

                const data = await response.json();
                console.log('FUNCIONA---------', data);



                const labelsEjemplo2 = data.map(item => item.Name_C);
                const valuesEjemplo2 = data.map(item => item.Importe_pen);

                const tipoGrafico2 = document.getElementById("tipoGrafico2");

                tipoGrafico2.addEventListener('change', function () {
                    const selectedType = tipoGrafico2.value;

                    if (selectedType === "bar" || selectedType === "line" || selectedType === "pie") {
                        renderizarGrafico2(labelsEjemplo2, valuesEjemplo2, selectedType);
                    } else {
                        console.error('Tipo de gráfico no válido:', selectedType);
                    }
                });



            } catch (error) {
                console.error('Error:', error);
            }
        }
    });



    let myChart2;

    function renderizarGrafico2(labels, values, typegrafico) {
        // Destruye el gráfico existente si ya existe
        if (myChart2) {
            myChart2.destroy();
        }

        const dynamicColors = () => {
            const r = Math.floor(Math.random() * 255);
            const g = Math.floor(Math.random() * 255);
            const b = Math.floor(Math.random() * 255);
            return `rgba(${r}, ${g}, ${b}, 0.2)`;
        };

        const backgroundColors = values.map(() => dynamicColors());

        // Obtén el contexto del canvas
        const ctx = document.getElementById('graficoBarras').getContext('2d');

        // Crea un nuevo gráfico con el tipo actualizado
        myChart2 = new Chart(ctx, {
            type: typegrafico,
            data: {
                labels: labels,
                datasets: [{
                    label: 'Cantidad',
                    data: values,
                    backgroundColor: backgroundColors,
                    borderColor: backgroundColors.map(color => color.replace('0.2', '1')), // Hace los bordes más oscuros
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    }

    // Función para renderizar el gráfico
    function renderizarGrafico(labels, values, typegrafico) {
        // Destruye el gráfico existente si ya existe
        if (myBarChart2) {
            myBarChart2.destroy();
        }

        const dynamicColors = () => {
            const r = Math.floor(Math.random() * 255);
            const g = Math.floor(Math.random() * 255);
            const b = Math.floor(Math.random() * 255);
            return `rgba(${r}, ${g}, ${b}, 0.2)`;
        };

        const backgroundColors = values.map(() => dynamicColors());

        // Crea un nuevo gráfico con el tipo actualizado
        myBarChart2 = new Chart(ctx, {
            type: typegrafico,
            data: {
                labels: labels,
                datasets: [{
                    label: 'Cantidad',
                    data: values,
                    backgroundColor: backgroundColors,
                    borderColor: backgroundColors.map(color => color.replace('0.2', '1')), // Hace los bordes más oscuros
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    }






});
