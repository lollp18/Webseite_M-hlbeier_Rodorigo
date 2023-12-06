const { createApp, ref } = Vue

const app = createApp({
  async beforeMount() {
    await this.CheckLogin()
    await this.GetAllKurse()
    await this.AddThemaop()
  },

  data() {
    return {
      Gebucht: [],
      filterop: [],
      AnmeldenErr: "",
      RegErr: "",
      schülerData: undefined,
      filter: "none",
      Kurse: [
        {
          Kurs_ID: "5",
          Kurs_Lehrer: "Müller",
          Kurs_Raum: "309",
          Preis: "50",
          Thema: "Mathe",
          Anzahl_Platz: "50",
          Anzahl_Frei: "10",
          Datum: "Donnerstag, 23. November 2023",
          Beginn: "11:25",
          Dauer: "120",
        },
        {
          Kurs_ID: "6",
          Kurs_Lehrer: "Schmidt",
          Kurs_Raum: "313",
          Preis: "60",
          Thema: "Deutsch",
          Anzahl_Platz: "70",
          Anzahl_Frei: "20",
          Datum: "Samstag, 25. November 2023",
          Beginn: "14:15",
          Dauer: "120",
        },
      ],
      Component: {
        Anmelden: false,
        Registriren: false,
        KursListe: true,
      },
      Anmelden: {
        Email: "lorenzo123696@gmail.com",
        Passwort: "1234",
      },
      Registriren: {
        Vorname: undefined,
        Nachname: undefined,
        Email: undefined,
        Passwort: undefined,
        Passwortwiderholen: undefined,
      },
    }
  },
  methods: {
    async EndKursBuchen(KursID) {
      const AnmeldenData = `SchülerID=${encodeURIComponent(
        this.schülerData.Schüler_ID
      )}&KursID=${encodeURIComponent(KursID)}`

      const res = await axios.post(`EndBuchen.php?${AnmeldenData}`)
      await this.CheckLogin()
      await this.GetAllKurse()
    },

    async GetGebucht() {
      const AnmeldenData = `SchülerID=${encodeURIComponent(
        this.schülerData.Schüler_ID
      )}`

      const res = await axios.post(`GetGebucht.php?${AnmeldenData}`)
      let temp = res.data.map((gebucht) => {
        return Number(gebucht.Kurs_ID)
      })

      this.Gebucht = temp
      console.log(this.Gebucht)
    },

    async KursBuchen(KursID) {
      const BuchenST = `KursID=${encodeURIComponent(
        KursID
      )}&Datum=${encodeURIComponent(
        this.getDatum()
      )}&SchülerID=${encodeURIComponent(this.schülerData.Schüler_ID)}`
      const res = await axios.post(`KursBuchen.php?${BuchenST}`)
      await this.CheckLogin()
      await this.GetAllKurse()
    },
    getDatum() {
      var aktuellesDatum = new Date()

      var tag = aktuellesDatum.getDate()
      var monat = aktuellesDatum.getMonth() + 1
      var jahr = aktuellesDatum.getFullYear()

      return tag + "." + monat + "." + jahr
    },
    Getopvalue(e) {
      this.filter = e.target.value
    },

    async AddThemaop() {
      let Temp = []
      Temp = this.Kurse.map((kurs) => {
        return kurs.Thema
      })
      Temp.push([
        "Montag",
        "Dienstag",
        "Mittwoch",
        "Donnerstag",
        "Freitag",
        "Samstag",
        "Sonntag",
      ])

      Temp = Temp.flat()

      this.filterop = Temp
    },

    AnmeldenAufrufen() {
      this.Component.Anmelden = true
      this.Component.Registriren = false
      this.Component.KursListe = false
    },

    Close() {
      this.Component.Anmelden = false
      this.Component.Registriren = false
      this.Component.KursListe = true
    },
    RegistrirenAufrufen() {
      this.Component.Registriren = true
      this.Component.Anmelden = false
      this.Component.KursListe = false
    },

    async GetAllKurse() {
      const res = await axios.get("./Kurse.php")
      this.Kurse = res.data
      console.log(this.Kurse)
    },
    async mAnmelden() {
      const AnmeldenData = `Email=${encodeURIComponent(
        this.Anmelden.Email
      )}&Passwort=${encodeURIComponent(this.Anmelden.Passwort)}`

      const res = await axios.post(`Anmelden.php?${AnmeldenData}`)

      if (Array.isArray(res.data)) {
        sessionStorage.setItem("buchen", JSON.stringify(this.Anmelden))
        this.schülerData = res.data[0]
        await this.GetGebucht()
        this.Close()
      } else {
        this.AnmeldenErr = res.data
      }
      console.log(res)
    },
    async mRegistriren() {
      const RegData = `Vorname=${encodeURIComponent(
        this.Registriren.Vorname
      )}&Nachname=${encodeURIComponent(
        this.Registriren.Nachname
      )}&Email=${encodeURIComponent(
        this.Registriren.Email
      )}&Passwort=${encodeURIComponent(
        this.Registriren.Passwort
      )}&Passwortwiderholen=${encodeURIComponent(
        this.Registriren.Passwortwiderholen
      )}`

      const res = await axios.post(`Reg.php?${RegData}`)

      if (res.data == "User Erstelt") {
        this.AnmeldenAufrufen()
      } else {
        this.RegErr = res.data
      }
    },
    async CheckLogin() {
      if (sessionStorage.length > 0) {
        const LoginData = JSON.parse(sessionStorage.getItem("buchen"))

        this.Anmelden = LoginData

        await this.mAnmelden()
      }
    },
  },
})

app.mount("#app")
