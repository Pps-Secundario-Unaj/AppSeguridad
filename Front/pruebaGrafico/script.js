document.addEventListener('DOMContentLoaded', () => {
    const mapaBerazategui = document.querySelector("#map-berazategui"); 
    const berazateguiGeojson = [
        'GeoJSON/Localidades_Berazategui/Berazategui_Berazategui.geojson',
        'GeoJSON/Localidades_Berazategui/Berazategui_ElPato.geojson',
        'GeoJSON/Localidades_Berazategui/Berazategui_Hudson.geojson',
        'GeoJSON/Localidades_Berazategui/Berazategui_Pereyra.geojson',
        'GeoJSON/Localidades_Berazategui/Berazategui_Ranelagh.geojson',
        'GeoJSON/Localidades_Berazategui/Berazategui_VillaEspana.geojson',
        'GeoJSON/Localidades_Berazategui/Berazategui_Platanos.geojson',
        'GeoJSON/Localidades_Berazategui/Berazategui_JMGutierrez.geojson',
        'GeoJSON/Localidades_Berazategui/Berazategui_Sourigues.geojson'
    ];
    const centroBera = [-58.1480, -34.8325];
    const zoomBera = 9.8;

    const mapaQuilmes = document.querySelector("#map-quilmes"); 
    const quilmesGeojson = [
        'GeoJSON/Localidades_Quilmes/Quilmes_Bernal.geojson',
        'GeoJSON/Localidades_Quilmes/Quilmes_DonBosco.geojson',
        'GeoJSON/Localidades_Quilmes/Quilmes_Ezpeleta.geojson',
        'GeoJSON/Localidades_Quilmes/Quilmes_LaFlorida.geojson',
        'GeoJSON/Localidades_Quilmes/Quilmes_Quilmes.geojson',
        'GeoJSON/Localidades_Quilmes/Quilmes_Solano.geojson'
    ];
    const centroQuilmes = [-58.2660,-34.7298];
    const zoomQuilmes = 10.6;

    const mapaVarela = document.querySelector("#map-varela"); 
    const varelaGeojson = [
        'GeoJSON/Localidades_Varela/Varela_GobernadorJulioCosta.geojson',
        'GeoJSON/Localidades_Varela/Varela_IngenieroJuanAllan.geojson',
        'GeoJSON/Localidades_Varela/Varela_LaCapilla.geojson',
        'GeoJSON/Localidades_Varela/Varela_VillaBrown.geojson',
        'GeoJSON/Localidades_Varela/Varela_VillaSanLuis.geojson',
        'GeoJSON/Localidades_Varela/Varela_VillaSantaRosa.geojson',
        'GeoJSON/Localidades_Varela/Varela_VillaVatteone.geojson',
        'GeoJSON/Localidades_Varela/Varela_Zeballos.geojson',
        'GeoJSON/Localidades_Varela/Varela_Bosques.geojson',
        'GeoJSON/Localidades_Varela/Varela_Varela.geojson'
    ];
    const centroVarela = [-58.2591, -34.8904];
    const zoomVarela = 9.8;
    
    crearGraficos();
    crearMapa(mapaVarela, varelaGeojson, centroVarela, zoomVarela);
    crearMapa(mapaBerazategui, berazateguiGeojson, centroBera, zoomBera);
    crearMapa(mapaQuilmes, quilmesGeojson, centroQuilmes, zoomQuilmes);
});

async function obtenerCantidadIncidentes(localidad) {
    try {
        const respuesta = await fetch('../../Back/pruebaGrafico/obtenerIncidentesLocalidades.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: `localidad=${encodeURIComponent(localidad)}`
        });

        if (!respuesta.ok) {
            throw new Error(`Error de red: ${respuesta.status}`);
        }

        const textoRespuesta = await respuesta.text();

        const datos = JSON.parse(textoRespuesta);
        if (datos.error) {
            console.error(`Error: ${datos.error}`);
            return 0;
        }

        return datos.total;
    } catch (error) {
        console.error('Error al obtener los incidentes:', error);
        return 0;
    }
}

async function obtenerCantidadIncidentesPartidos(partido) {
    try {
        const respuesta = await fetch('../../Back/pruebaGrafico/obtenerIncidentesPartidos.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: `partido=${encodeURIComponent(partido)}`
        });

        if (!respuesta.ok) {
            throw new Error(`Error de red: ${respuesta.status}`);
        }

        const textoRespuesta = await respuesta.text();
        console.log("Respuesta recibida:", textoRespuesta);

        const datos = JSON.parse(textoRespuesta);
        if (datos.error) {
            console.error(`Error: ${datos.error}`);
            return 0;
        }

        return datos.total;
    } catch (error) {
        console.error('Error al obtener los incidentes:', error);
        return 0;
    }
}

// Inicializador de graficos
async function crearGraficos(){
    const todosLosPartidos = ['Berazategui', 'Florencio Varela', 'Quilmes'];
    const incidentesTotal = await Promise.all(todosLosPartidos.map(partido => obtenerCantidadIncidentesPartidos(partido)));

    // Grafico de torta global
    const ctxPieAll = document.getElementById('pieChartAll').getContext('2d');
    new Chart(ctxPieAll, {
        type: 'pie',
        data: {
            labels: todosLosPartidos,
            datasets: [{
                data: incidentesTotal,
                backgroundColor: ['#FFA500', '#4CAF50', '#00008B'],
                borderColor: '#000',
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'top' },
                tooltip: { callbacks: { label: tooltipItem => `${tooltipItem.label}: ${tooltipItem.raw}` } }
            }
        }
    });

    // Configuración de los gráficos de torta y columnas para Berazategui
   /* const ctxPieBerazategui = document.getElementById('pieChartBerazategui').getContext('2d');
    const pieChartBerazategui = new Chart(ctxPieBerazategui, {
        type: 'pie',
        data: {
            labels: ['Hudson', 'Juan María Gutiérrez', 'Ranelagh', 'Berazategui', 'Sourigues', 'Pereyra', 'Plátanos', 'Villa España', 'El Pato'],
            datasets: [{
                label: 'Distribución de Delitos',
                data: [12, 15, 20, 10, 8, 7, 5, 3], // Datos ficticios
                backgroundColor: '#FFA500', // Naranja para Berazategui
                borderColor: '#fff',
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return `${tooltipItem.label}: ${tooltipItem.raw}%`;
                        }
                    }
                }
            }
        }
    });*/

    const ctxBarBerazategui = document.getElementById('barChartBerazategui').getContext('2d');

    const localidadesBerazategui = [
        'Berazategui',
        'El Pato',
        'Hudson',
        'Juan Maria Gutierrez',
        'Pereyra',
        'Platanos',
        'Ranelagh',
        'Sourigues',
        'Villa España'
    ];

    const incidentesBerazategui = await Promise.all(localidadesBerazategui.map(localidad => obtenerCantidadIncidentes(localidad)));

    const barChartBerazategui = new Chart(ctxBarBerazategui, {
        type: 'bar',
        data: {
            labels: localidadesBerazategui,
            datasets: [{
                label: 'Incidentes:',
                data: incidentesBerazategui,
                backgroundColor: '#FFA500', // Naranja para Berazategui
                borderColor: '#BF360C',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Cantidad de Incidentes'
                    }
                }
            },
            plugins: {
                legend: {
                    display: false,
                },
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return `${tooltipItem.dataset.label}: ${tooltipItem.raw}`;
                        }
                    }
                }
            }
        }
    });

    // Configuración de los gráficos de torta y columnas para Varela
    /* const ctxPieVarela = document.getElementById('pieChartVarela').getContext('2d');
    const pieChartVarela = new Chart(ctxPieVarela, {
        type: 'pie',
        data: {
            labels: ['Bosques', 'Estanislao Severo Zeballos', 'San Juan Bautista', 'Gobernador Julio A. Costa', 'Ingeniero Juan Allan', 'Villa Brown', 'Villa San Luis', 'Villa Santa Rosa', 'Villa Vatteone', 'La Capilla'],
            datasets: [{
                label: 'Distribución de Delitos',
                data: [10, 12, 15, 13, 10, 8, 6, 5, 4, 3], // Datos ficticios
                backgroundColor: '#4CAF50', // Verde para Varela
                borderColor: '#fff',
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return `${tooltipItem.label}: ${tooltipItem.raw}%`;
                        }
                    }
                }
            }
        }
    });*/

    const ctxBarVarela = document.getElementById('barChartVarela').getContext('2d');

    const localidadesVarela = [
        'Bosques', 
        'Gobernador Julio Costa', 
        'Ingeniero Juan Allan', 
        'La Capilla', 
        'Varela', 
        'Villa Brown', 
        'Villa San Luis', 
        'Villa Santa Rosa', 
        'Villa Vatteone', 
        'Zeballos'
    ];

    const incidentesVarela = await Promise.all(localidadesVarela.map(localidad => obtenerCantidadIncidentes(localidad)));

    const barChartVarela = new Chart(ctxBarVarela, {
        type: 'bar',
        data: {
            labels: localidadesVarela,
            datasets: [{
                label: 'Incidentes:',
                data: incidentesVarela,
                backgroundColor: '#4CAF50', // Verde para Varela
                borderColor: '#388E3C',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Cantidad de Incidentes'
                    }
                }
            },
            plugins: {
                legend: {
                    display: false,
                },
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return `${tooltipItem.dataset.label}: ${tooltipItem.raw}`;
                        }
                    }
                }
            }
        }
    });

    // Configuración de los gráficos de torta y columnas para Quilmes
   /* const ctxPieQuilmes = document.getElementById('pieChartQuilmes').getContext('2d');
    const pieChartQuilmes = new Chart(ctxPieQuilmes, {
        type: 'pie',
        data: {
            labels: ['Bernal', 'Don Bosco', 'Ezpeleta', 'Quilmes', 'San Francisco Solano', 'Villa la Florida'],
            datasets: [{
                label: 'Distribución de Delitos',
                data: [20, 25, 15, 30, 5, 5], // Datos ficticios
                backgroundColor: '#00008B', // Azul para Quilmes
                borderColor: '#fff',
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return `${tooltipItem.label}: ${tooltipItem.raw}%`;
                        }
                    }
                }
            }
        }
    });*/

    const ctxBarQuilmes = document.getElementById('barChartQuilmes').getContext('2d');

    const localidadesQuilmes = [
        'Bernal', 
        'Don Bosco', 
        'Ezpeleta', 
        'Villa La Florida', 
        'Quilmes', 
        'Solano'
    ];

    const incidentesQuilmes = await Promise.all(localidadesQuilmes.map(localidad => obtenerCantidadIncidentes(localidad)));

    const barChartQuilmes = new Chart(ctxBarQuilmes, {
        type: 'bar',
        data: {
            labels: localidadesQuilmes,
            datasets: [{
                label: 'Incidentes:',
                data: incidentesQuilmes,
                backgroundColor: '#00008B', // Azul para Quilmes
                borderColor: '#1976D2',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Cantidad de Incidentes'
                    }
                }
            },
            plugins: {
                legend: {
                    display: false,
                },
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return `${tooltipItem.dataset.label}: ${tooltipItem.raw}`;
                        }
                    }
                }
            }
        }
    });
    }

let idLocalidadSeleccionada = null; 
let mapaSeleccionado = null;
// Inicializador de mapas
function crearMapa(contenedorHTML, arrayGeojson, centro, zoom) {
    const nombre = contenedorHTML.getAttribute("data-localidad");

    const map = new maplibregl.Map({
        container: contenedorHTML, 
        style: {
            "version": 8,
            "sources": {
                "osm-tiles": {
                    "type": "raster",
                    "tiles": [
                        "https://tile.openstreetmap.org/{z}/{x}/{y}.png"
                    ],
                    "tileSize": 256
                }
            },
            "layers": [
                {
                    "id": "background",
                    "type": "background",
                    "paint": {
                        "background-color": "#ffffff" 
                    },
                    "filter": [
                    "all"
                        ],
                    "layout": {
                        "visibility": "visible"
                    },
                },
                {
                    "id": "osm-tiles",
                    "type": "raster",
                    "source": "osm-tiles",
                    "minzoom": 0,
                    "maxzoom": 19,
                    "paint": {
                        "raster-opacity": 1
                    }
                }
            ]
        },
        center: centro,
        zoom: zoom,
        interactive: false
    });



    const tooltip = document.getElementById('map-tooltip');

    Promise.all(arrayGeojson.map(archivo =>
        fetch(archivo)
            .then(response => response.json())
            .then(data => ({ data }))
    ))
    .then(results => {
        results.forEach((result, index) => {
            const { data } = result;
            const layerId = `layer-${index}-${nombre}`;
            const sourceId = `source-${index}-${nombre}`;

            map.addSource(sourceId, {
                'type': 'geojson',
                'data': data
            });

            map.addLayer({
                'id': layerId,
                'type': 'fill',
                'source': sourceId,
                'paint': {
                    'fill-color': '#888888',
                    'fill-outline-color': 'red',
                    'fill-opacity': 0.4,
                },
                'filter': ['==', '$type', 'Polygon']
            });
        });

        map.on('click', (e) => {
            const objetoMapa = map.queryRenderedFeatures(e.point);

            if (objetoMapa.length > 0) {
                // Deseleccionar la localidad previamente seleccionada
                if (idLocalidadSeleccionada) {
                    const layerAnterior = idLocalidadSeleccionada;
                    const mapaAnterior = mapaSeleccionado;

                    // Restablecer el color de la capa anterior
                    mapaAnterior.setPaintProperty(layerAnterior, 'fill-color', '#888888');
                }

                // Cambiar a la nueva localidad seleccionada
                idLocalidadSeleccionada = objetoMapa[0].layer.id;
                mapaSeleccionado = map; // Guardar el mapa actual

                map.setPaintProperty(idLocalidadSeleccionada, 'fill-color', '#333');

                const description = objetoMapa[0].properties.name || 'Sin nombre';
                tooltip.innerHTML = `<strong>${description}</strong>`;
                tooltip.style.display = 'block';
                tooltip.style.left = `${e.originalEvent.pageX + 15}px`;
                tooltip.style.top = `${e.originalEvent.pageY + 15}px`;
            } else {
                // Deseleccionar si se hace clic en el vacío
                if (idLocalidadSeleccionada) {
                    map.setPaintProperty(idLocalidadSeleccionada, 'fill-color', '#888888');
                    idLocalidadSeleccionada = null;
                    mapaSeleccionado = null; // Limpiar la referencia al mapa
                }
                tooltip.style.display = 'none';
            }
        });
    })
    .catch(error => {
        console.error('Error loading the GeoJSON files:', error);
    });

    return map;
}