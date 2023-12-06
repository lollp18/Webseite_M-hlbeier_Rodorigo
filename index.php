<!DOCTYPE html>
<html lang="de">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kurs Buchen</title>
  <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
  <link rel="stylesheet" href="style.css" />

</head>

<body>
  <div id="app">
    <header>
      <h2 v-if="schülerData!=undefined">
        Hallo {{schülerData.Vorname}} {{schülerData.Nachname}}
      </h2>
      <select @change="Getopvalue($event)">
        <option value="none">Kein Filter</option>
        <option v-for="op in filterop" :value="op">{{op}}</option>

      </select>
      <button v-if="schülerData==undefined" @click=" AnmeldenAufrufen()">Anmelden</button>
      <button v-if="schülerData==undefined" @click="RegistrirenAufrufen()">Registrieren</button>
    </header>
    <main>

      <!-- Anmelden -->
      <div class="Login" v-if="Component.Anmelden">
        <form>
          <h1>Anmelden</h1>
          <h2>{{AnmeldenErr}}</h2>
          <input v-model="this.Anmelden.Email" type="text" placeholder="Email" />
          <input v-model="this.Anmelden.Passwort" type="text" placeholder="Passwort" />
          <button @click.prevent="mAnmelden()">Anmelden</button>
          <button @click="Close()">X</button>
        </form>
      </div>

      <!-- Registriren -->
      <div class="Login" v-if="Component.Registriren">

        <form>
          <h1>Registrieren</h1>
          <h2>{{RegErr}}</h2>
          <input v-model="this.Registriren.Nachname" type="text" placeholder="Nachname" />
          <input v-model="this.Registriren.Vorname" type="text" placeholder="Vorname" />
          <input v-model="this.Registriren.Email" type="text" placeholder="Email" />
          <input v-model="this.Registriren.Passwort" type="text" placeholder="Passwort" />
          <input v-model="this.Registriren.Passwortwiderholen" type="text" placeholder="Passwortwiederholen" />
          <button @click.prevent="mRegistriren()">Konto Erstellen</button>
          <button @click="Close()">X</button>
        </form>
      </div>
      <!-- KursListe -->
      <div class="KursListe" v-if="Component.KursListe">


        <template v-for="{Preis,Thema,Beginn,Dauer,Anzahl_Frei,Kurs_Raum,Datum,Kurs_Lehrer,Kurs_ID} in this.Kurse">
          <div class="item" v-if="Thema==filter|| Datum.includes(filter)">

            <div class="ItemHeader">
              <button v-if="Gebucht.includes(Number(Kurs_ID)) && schülerData!=undefined " @click="EndKursBuchen(Kurs_ID)">EndBuchen</button>
              <button v-else-if="schülerData!=undefined" @click=" KursBuchen(Kurs_ID)">Buchen</button>
              <h1 class="inforapper"> {{Thema}}</h1>
              <div class="inforapper">
                <h3>Preis</h3>
                <h4>{{Preis}}&euro;</h4>
              </div>
            </div>



            <div class="rapperZeitRaum">
              <div class=" Zeit">
                <div class="inforapper">
                  <h3>Datum</h3>
                  <h4>{{Datum}}</h4>
                </div>
                <div style=" display: flex; gap: 3rem; justify-content: center;">
                  <div class="inforapper">
                    <h3>Beginn</h3>
                    <h4>{{Beginn}} Uhr</h4>
                  </div>
                  <div class="inforapper">
                    <h3>Dauer</h3>
                    <h4>{{Dauer}} min</p>
                  </div>
                </div>
              </div>

              <div style=" display: flex; gap: 3rem;">
                <div class="inforapper">
                  <h3>Lehrer</h3>
                  <h4>{{Kurs_Lehrer}}</h4>
                </div>
                <div class="inforapper">
                  <h3>Freieplätze</h3>
                  <h4>{{Anzahl_Frei}}</h4>
                </div>
                <div class="inforapper">
                  <h3>Raum Nr<h3>
                      <h4>{{Kurs_Raum}}
                        <h4>
                </div>
              </div>
            </div>

          </div>
          <div class="item" v-else-if="filter=== 'none' ">

            <div class="ItemHeader">

              <button v-if="Gebucht.includes(Number(Kurs_ID)) && schülerData!=undefined" @click="EndKursBuchen(Kurs_ID)">EndBuchen</button>
              <button v-else-if="schülerData!=undefined" @click="KursBuchen(Kurs_ID)">Buchen</button>
              <h1 class="inforapper"> {{Thema}}</h1>
              <div class="inforapper">
                <h3>Preis</h3>
                <h4>{{Preis}}&euro;</h4>
              </div>
            </div>



            <div class="rapperZeitRaum">
              <div class=" Zeit">
                <div class="inforapper">
                  <h3>Datum</h3>
                  <h4>{{Datum}}</h4>
                </div>
                <div style=" display: flex; gap: 3rem; justify-content: center;">
                  <div class="inforapper">
                    <h3>Beginn</h3>
                    <h4>{{Beginn}} Uhr</h4>
                  </div>
                  <div class="inforapper">
                    <h3>Dauer</h3>
                    <h4>{{Dauer}} min</p>
                  </div>
                </div>
              </div>

              <div style=" display: flex; gap: 3rem;">
                <div class="inforapper">
                  <h3>Lehrer</h3>
                  <h4>{{Kurs_Lehrer}}</h4>
                </div>
                <div class="inforapper">
                  <h3>Freieplätze</h3>
                  <h4>{{Anzahl_Frei}}</h4>
                </div>
                <div class="inforapper">
                  <h3>Raum Nr<h3>
                      <h4>{{Kurs_Raum}}
                        <h4>
                </div>
              </div>
            </div>
        </template>
      </div>

    </main>
  </div>
  <script src="./app.js">

  </script>
</body>

</html>