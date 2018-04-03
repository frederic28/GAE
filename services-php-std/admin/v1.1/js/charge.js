/**
 * Objet charge prennant en charge l'appel à l'api sur service charge
 * POST /charge/send v2.0
 *
 * Dans votre page
 * Inclure la lib <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
 *
 * L'affichage du graphique se fait dans un div dont l'id doit être la valeur de la constante CHART_DIV
 * exemple : <div id="id_chart_div" ></div>
 *
 * exemple d'appel :
 *  <label>Nombre de requettes : </label><input id="nbr_req" type="number" required>
 *  <label>Nombre de paquets : </label><input id="nbr_paq" type="number" required>
 *  <button onclick="Charge.api_send( document.getElementById('nbr_req').value, document.getElementById('nbr_paq').value);">Send</button>
 *
 */
const CHART_DIV = "id_chart_div";
const API_CHARGE = "/charge/send";

Charge = {

        /**
         * data contient les données au format pris en compte par google chart
         * [
         *      ['numero paquet', 'Temps moyen']
         *      ['1', 0.02 ],
         *      ['2', 0.003 ],
         *      ...
         * ]
         */
        data : [],
        compteur : 0,

        /**
         * Appel l'api nbrPaquet fois en passant en parmètre via POST la taillePaquet
         * @param taillePaquet
         * @param nbrPaquet
         */
        api_send : ( taillePaquet = 10, nbrPaquet = 1, nbrVersion = 3) => {
        if (Charge.compteur !== 0) { // test si un appel n'est pas déjà en cours
    return;
}
Charge.data = [['Numero paquet', 'temps moyen', 'version']], // titre des deux colonnes
    Charge.compteur = nbrPaquet;
for (  let i = 0 ; i< nbrPaquet ; i++ ) {
    $.ajax({
        method: "POST",
        data: { nbr_requests : taillePaquet, nbrVersion: nbrVersion },
        url: API_CHARGE,
    }).done( (rep) => {
        Charge.run_graph(); // génére une demande d'affichage
    let numeroOrdreArrive = nbrPaquet-(--Charge.compteur);
    Charge.data.push( [ numeroOrdreArrive.toString(), rep.moyenne, numeroOrdreArrive.toString()] );
});
}
},

/**
 * initialise les fonctions google pour générer les graphiques
 */
run_graph: ( ) => {
    google.charts.load("current", {packages: ['corechart', 'bar']});
    google.charts.setOnLoadCallback(Charge.draw_chart);
},

/**
 * Affichage dans le div d'id CHART_DIV
 * type d'affichage ColumnChart
 */
draw_chart: () => {
    let data = google.visualization.arrayToDataTable(  Charge.data  );
    let options = {
        title: 'Temps moyen par paquets',
        legend: {position: 'none'},
    };

    let chart = new google.visualization.ColumnChart(document.getElementById(CHART_DIV));
    chart.draw(data, options);
}
};