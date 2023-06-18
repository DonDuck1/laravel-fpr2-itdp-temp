# Security Opdracht 3 Joan Maljers

## Auteurs
* **Joan Maljers** - *De site laten werken, inclusief IDOR toevoegen* - [Joan Maljers](https://github.com/DonDuck1)

## Instructies
Snooping en session hijacking worden voorkomen door gebruik te maken van HTTPS en TLS (oftewel er wordt gebruikgemaakt van een 'SSL Certificate')

Er zijn 3 rollen: 'Administrator', 'Manager' en 'User'. De rechten van elke gebruiker (zoals het zou moeten zijn):
Iemand met de rol 'Administrator' heeft het recht om:
- Nieuwe gebruikers te registreren. Ze kunnen echter niet nieuwe gebruikers de rol 'Administrator' geven, dat zou moeten via de database. Ook kunnen ze accounts niet aanpassen na aanmaak (behalve via de database) en kunnen ze ze niet verwijderen (behalve via de database).
- Alle organisaties bekijken, nieuwe organisaties aan te maken, bestaande organisaties bewerken en verwijderen
- Alle afdelingen bekijken, nieuwe afdelingen maken, bestaande afdelingen bewerken en verwijderen

Iemand met de rol 'Manager' heeft het recht om:
- De bestaande organisatie waar hij bij hoort bekijken en bewerken.
- De bestaande afdelingen die horen bij zijn organisatie bekijken, nieuwe afdelingen die bij zijn organisatie horen maken, bestaande afdelingen die bij zijn organisatie horen wijzigen en verwijderen.

Iemand met de rol 'User' heeft het recht om:
- De bestaande organisatie waar hij bij hoort bekijken.
- De bestaande afdelingen die horen bij zijn organisatie bekijken.

Ik zal nu alle links geven die beschikbaar zijn voor de website wanneer hij net vers is gemigrate en geseed, en wat de links inhouden en voor wie ze beschikbaar zijn. '...' is de link naar de hoofdpagina/ welkomspagina van mijn site. Om IDOR aan te tonen kun je deze links in de zoekbalk van de browser plakken wanneer je bent ingelogd als verschillende gebruikers.
<br>
<br>
.../login -> Dient om gebruikers in te laten loggen. Beschikbaar voor iedereen.
<br>
<br>
.../ -> hoofdpagina/ welkomspagina. Beschikbaar voor iedereen.
<br>
<br>
.../dashboard -> dashboard. Beschikbaar voor iedereen.
<br>
<br>
.../organisations -> tabel met alle organisaties. Beschikbaar voor administrator.
<br>
<br>
.../organisations/280ac77a-9bca-4d9c-aa0c-cbc6f39b6717 -> informatie over organisatie 'John's Space Agency'. Beschikbaar voor administrator, manager van deze organisatie en user van deze organisatie.
<br>
<br>
.../organisations/280ac77a-9bca-4d9c-aa0c-cbc6f39b6717/edit -> wijzig informatie over organisatie 'John's Space Agency'. Beschikbaar voor administrator, manager van deze organisatie.
<br>
<br>
.../organisations/8a9aebaf-f596-475b-94aa-7bc43af5e4e9 -> informatie over organisatie 'Jane's Commercial Space Flights'. Beschikbaar voor administrator, manager van deze organisatie en user van deze organisatie.
<br>
<br>
.../organisations/8a9aebaf-f596-475b-94aa-7bc43af5e4e9/edit -> wijzig informatie over organisatie 'John's Space Agency'. Beschikbaar voor administrator, manager van deze organisatie.
<br>
<br>
.../departments -> tabel met alle afdelingen. Beschikbaar voor administrator.
<br>
<br>
.../departments/02a11954-5a03-4c26-9bd1-21e06cf27d1b -> informatie over afdeling 'John's Alien Observers' van organisatie 'John's Space Agency'. Beschikbaar voor administrator, manager van de organisatie waar deze afdeling bij hoort en user van de organisatie waar deze afdeling bij hoort.
<br>
<br>
.../departments/02a11954-5a03-4c26-9bd1-21e06cf27d1b/edit -> wijzig informatie over afdeling 'John's Alien Observers' van organisatie 'John's Space Agency'. Beschikbaar voor administrator, manager van de organisatie waar deze afdeling bij hoort.
<br>
<br>
.../departments/349a5e02-10fc-4bbc-b583-c9b59095b2ce -> informatie over afdeling 'Jane's Safety Videos' van organisatie 'Jane's Commercial Space Flights'. Beschikbaar voor administrator, manager van de organisatie waar deze afdeling bij hoort en user van de organisatie waar deze afdeling bij hoort.
<br>
<br>
.../departments/349a5e02-10fc-4bbc-b583-c9b59095b2ce/edit -> wijzig informatie over afdeling 'Jane's Safety Videos' van organisatie 'Jane's Commercial Space Flights'. Beschikbaar voor administrator, manager van de organisatie waar deze afdeling bij hoort.
<br>
<br>
.../departments/5ad872f5-1a85-42e6-a4fc-6788227c6a55 -> informatie over afdeling 'Jane's Spicy Engines' van organisatie 'Jane's Commercial Space Flights'. Beschikbaar voor administrator, manager van de organisatie waar deze afdeling bij hoort en user van de organisatie waar deze afdeling bij hoort.
<br>
<br>
.../departments/5ad872f5-1a85-42e6-a4fc-6788227c6a55/edit -> wijzig informatie over afdeling 'Jane's Spicy Engines' van organisatie 'Jane's Commercial Space Flights'. Beschikbaar voor administrator, manager van de organisatie waar deze afdeling bij hoort.
<br>
<br>
.../departments/67392d6a-d4ad-4bdd-bb67-c4880e57652d -> informatie over afdeling 'John's Astronaut Training' van organisatie 'John's Space Agency'. Beschikbaar voor administrator, manager van de organisatie waar deze afdeling bij hoort en user van de organisatie waar deze afdeling bij hoort.
<br>
<br>
.../departments/67392d6a-d4ad-4bdd-bb67-c4880e57652d/edit -> wijzig informatie over afdeling 'John's Astronaut Training' van organisatie 'John's Space Agency'. Beschikbaar voor administrator, manager van de organisatie waar deze afdeling bij hoort.
<br>
<br>
.../departments/8a6ce960-4860-428c-8d78-38fa4013ef24 -> informatie over afdeling 'John's Rocket R&D' van organisatie 'John's Space Agency'. Beschikbaar voor administrator, manager van de organisatie waar deze afdeling bij hoort en user van de organisatie waar deze afdeling bij hoort.
<br>
<br>
.../departments/8a6ce960-4860-428c-8d78-38fa4013ef24/edit -> wijzig informatie over afdeling 'John's Rocket R&D' van organisatie 'John's Space Agency'. Beschikbaar voor administrator, manager van de organisatie waar deze afdeling bij hoort.

# Om de 'store', 'update' en 'delete' routes proberen te bereiken kun je respectievelijk de volgende code toevoegen aan de site via de webeditor:
# 'Store' organisation (alleen administrator):
```
<form method="POST" action=".../organisations">
    <input type="hidden" name="_token" value="{{ Deze value is te vinden door bijvoorbeeld als manager naar een department te gaan en via de webeditor de value van de delete knop daar opzoeken }}">
    <div class="field">
        <label class="label" for="name">Organisation name</label>
        <div class="control">
            <input class="input" type="text" name="name" id="name" size="80" value="">
        </div>
    </div>

    <div class="field">
        <label class="label" for="active">Active</label>
        <div class="control">
            <select id="active" name="active">
                <option value="1">True</option>
                <option value="0">False</option>
            </select>
        </div>
    </div>

    <div class="field is-grouped">
        <div class="control">
            <button class="submit_button_blogs" type="submit">Submit</button>
        </div>
    </div>
</form>
```

# 'Update' organisation (adminstrator, manager kan alleen van zijn eigen organisatie info wijzigen):
```
<form method="POST" action=".../organisations/{{ organisation uuid }}">
    <input type="hidden" name="_token" value="{{ Deze value is te vinden door bijvoorbeeld als manager naar een department te gaan en via de webeditor de value van de delete knop daar opzoeken }}">
    <input type="hidden" name="_method" value="PUT">            
    <div class="field">
        <label class="label" for="name">Organisation Name</label>
        <div class="control">
            <input class="input" type="text" name="name" id="name" value="Jane's Commercial Space Flights" size="80">
        </div>
    </div>

    <div class="field">
        <label class="label" for="active">Active</label>
        <div class="control">
            <select id="active" name="active">
                <option value="1" selected="">True</option>
                <option value="0">False</option>
            </select>
        </div>
    </div>

    <div class="field is-grouped">
        <div class="control">
            <button class="submit_button_blogs" type="submit">Submit</button>
        </div>
    </div>
</form>
```

# 'Delete' organisation (alleen administrator):
```
<form method="POST" action=".../organisations/{{ organisation uuid }}">
    <input type="hidden" name="_token" value="{{ Deze value is te vinden door bijvoorbeeld als manager naar een department te gaan en via de webeditor de value van de delete knop daar opzoeken }}">
    <input type="hidden" name="_method" value="DELETE">
    <button type="submit">Delete</button>
</form>
```

# 'Store' department (adminstrator, manager kan alleen afdelingen bij eigen organisatie toevoegen):
```
<form method="POST" action=".../public/departments">
    <input type="hidden" name="_token" value="{{ Deze value is te vinden door bijvoorbeeld als manager naar een department te gaan en via de webeditor de value van de delete knop daar opzoeken }}">
    <div class="field">
        <label class="label" for="name">Department name</label>
        <div class="control">
            <input class="input" type="text" name="name" id="name" size="80" value="">
        </div>
    </div>

    <div class="field">
        <label class="label" for="active">Active</label>
        <div class="control">
            <select id="active" name="active">
                <option value="1">True</option>
                <option value="0">False</option>
            </select>
        </div>
    </div>

    <div class="field">
        <label class="label" for="organisation">Organisation</label>
        <div class="control">
            <select id="organisation" name="organisation">
                <option value="" selected="" disabled="" hidden="">-- Choose an organisation --</option>
                <option value="John's Space Agency">John's Space Agency</option>
                <option value="Jane's Commercial Space Flights">Jane's Commercial Space Flights</option>
            </select>
        </div>
    </div>
            

    <div class="field is-grouped">
        <div class="control">
            <button class="submit_button_blogs" type="submit">Submit</button>
        </div>
    </div>
</form>
```

# 'Update' department (adminstrator, manager kan alleen afdelingen van eigen organisatie wijzigen):
```
<form method="POST" action=".../departments/{{ department uuid }}">
    <input type="hidden" name="_token" value="{{ Deze value is te vinden door bijvoorbeeld als manager naar een department te gaan en via de webeditor de value van de delete knop daar opzoeken }}">
    <input type="hidden" name="_method" value="PUT">            
        <div class="field">
        <label class="label" for="name">Department Name</label>
        <div class="control">
            <input class="input" type="text" name="name" id="name" value="John's Alien Observers" size="80">
        </div>
    </div>

    <div class="field">
        <label class="label" for="active">Active</label>
        <div class="control">
            <select id="active" name="active">
                <option value="1" selected="">True</option>
                <option value="0">False</option>
            </select>
        </div>
    </div>

    <div class="field">
        <label class="label" for="organisation">Organisation</label>
        <div class="control">
            <select id="organisation" name="organisation">
                <option value="1">Create new</option>
                <option value="John's Space Agency" selected="">John's Space Agency</option>
                <option value="Jane's Commercial Space Flights">Jane's Commercial Space Flights</option>
            </select>
        </div>
    </div>
            
    <div class="field is-grouped">
        <div class="control">
            <button class="submit_button_blogs" type="submit">Submit</button>
        </div>
    </div>
</form>
```

# 'Delete' department (adminstrator, manager kan alleen afdelingen van eigen organisatie verwijderen):
```
<form method="POST" action=".../departments/{{ department uuid }}">
    <input type="hidden" name="_token" value="{{ Deze value is te vinden door bijvoorbeeld als manager naar een department te gaan en via de webeditor de value van de delete knop daar opzoeken }}">
    <input type="hidden" name="_method" value="DELETE">            
    <button type="submit">Delete</button>
</form>
```
