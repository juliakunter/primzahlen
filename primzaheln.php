<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Zahlenwerkzeug</title>
<style>
    /* Grundlegendes Styling für die Seite */
    body { font-family: Arial; margin: 20px; }

    /* Eingabefelder etwas polstern */
    input { padding: 4px; }

    /* Buttons mit etwas Abstand und Polsterung */
    button { padding: 5px 12px; margin-left: 5px; }

    /* Ausgabebereich als grauer Block mit Umbruch */
    pre { background: #eaeaea; padding: 10px; white-space: pre-wrap; margin-top: 10px; }
</style>
</head>
<body>
 
<h1>Zahlenanalyse</h1>
 
<!-- Abschnitt 1 – Primzahlen -->
<section>
<h2>Primzahlen berechnen</h2>
 
    <!-- Eingabefeld für die Obergrenze -->
    <label>Bis wohin prüfen?</label>
    <input type="number" id="grenzeP" min="2" value="50">
    <!-- Button zum Starten der Berechnung -->
    <button onclick="primstart()">Start</button>
 
    <!-- Ausgabebereich für die Primzahlen -->
    <pre id="primOut"></pre>
</section>
 
<hr>
 
<!-- Abschnitt 2 – Logarithmus -->
<section>
<h2>Logarithmus-Wert als Sternfolge</h2>
 
    <!-- Erklärung des Features -->
    <p>Es wird für alle Zahlen 1 bis n log10(x) berechnet und proportional als Sternchenreihe ausgegeben.</p>
 
    <!-- Eingabefeld für die Obergrenze -->
    <label>Obergrenze:</label>
    <input type="number" id="logRange" min="1" value="100">
    <!-- Button zum Anzeigen der Sternfolge -->
    <button onclick="buildLog()">Anzeigen</button>
 
    <!-- Ausgabebereich für die Stern-Darstellung -->
    <pre id="logOut"></pre>
</section>
 
<script>
    // FUNKTION: PRIMZAHLEN BERECHNEN
    function primstart() {
        // Hole den Wert aus dem Eingabefeld
        let ende = Number(document.getElementById("grenzeP").value);

        // Referenz auf den Ausgabebereich
        let box = document.getElementById("primOut");

        // Array für gefundene Primzahlen
        let liste = [];
 
        // Schleife über alle Zahlen von 2 bis zur Obergrenze
        for (let n = 2; n <= ende; n++) {
            let ok = true; // Annahme: Zahl ist prim
 
            // Prüfe alle möglichen Teiler von 2 bis n/2
            for (let z = 2; z <= Math.floor(n / 2); z++) {
                if (n % z === 0) {
                    ok = false; // Teiler gefunden → keine Primzahl
                    break; // Schleife abbrechen
                }
            }

            // Wenn ok true bleibt, ist die Zahl prim
            if (ok) liste.push(n);
        }
 
        // Ausgabe der gefundenen Primzahlen
        box.textContent = "Gefundene Primzahlen:\n" + liste.join(", ");
    }

    // FUNKTION: LOGARITHMUS ALS STERNFOLGE
    function buildLog() {
        // Hole die Obergrenze aus dem Eingabefeld
        let bis = Number(document.getElementById("logRange").value);
        
        // String für die Ausgabe
        let ausgabe = "";

        // Referenzwert: log10 der größten Zahl (für Skalierung)
        let ref = Math.log10(bis > 1 ? bis : 2);
        
        // Maximale Länge der Sternreihe
        let maxLen = 40;
 
        // Schleife über alle Zahlen von 1 bis Obergrenze
        for (let k = 1; k <= bis; k++) {
            // Berechne log10(k)
            let w = Math.log10(k);

            // Berechne die Anzahl Sterne proportional zur Referenz
            let sterne = ref > 0 ? Math.floor((w / ref) * maxLen) : 0;
 
            // Baue die Zeile: Zahl + Doppelpunkt + Sterne
            let zeile = "";
            zeile += (k + "").padStart(3, " "); // Zahl rechtsbündig
            zeile += " : ";
            zeile += "*".repeat(sterne); // Sterne hinzufügen
 
            // Füge die Zeile zur Gesamtausgabe hinzu
            ausgabe += zeile + "\n";
        }
 
        // Ausgabe in den vorgesehenen Bereich
        document.getElementById("logOut").textContent = ausgabe;
    }
</script>
</body>
</html>