Redovisning
=========================

##Kmom01

###Gör din egen kunskapsinventering baserat på PHP The Right Way, berätta om dina styrkor och svagheter som du vill förstärka under det kommande året.
Tittar jag tillbaka på översikten av PHP The Right Way så är det första jag tänker på testning. Vi gjorde det lite i föregående kurs, men jag känner att det är inget jag har särskilt bra koll på.

Säkerhet är en del jag skulle kunna förstärka. Jag känner ändå att jag ungefär vet vad som behöver göras för att det ska vara någorlunda säkert, men exakt hur man gör det är en annan fråga. Andra saker jag känner skulle behöva övas mer på är bland annat - dependency injection, servers and deployment, virtualization och caching.

Databaser och att använda PDO känns ändå som jag har ganska bra koll på. Det känns iallafall inte så hemskt att jobba med det. Templating känner jag nog att jag vet hur det fungerar. Det går även här att bli bättre, men jämfört med tidigare nämnda saker så har jag bättre koll på templating.

###Vilket blev resultatet från din mini-undersökning om vilka ramverk som för närvarande är mest populära inom PHP (ange källa var du fann informationen)?
Jag började med att göra en enkel google-sökning på “php framework”. De två översta resultaten var inga ramverk utan sidor som jämförde olika ramverk. Däremot var redan det tredje sökresultat ett ramverk, Laravel. Slim Framework och Symfony dök även upp längre ner på sidan.

På Google Trends är resultat också väldigt tydligt, Laravel är överlägset mest populärt. Därefter kommer Symfony och Codeigniter väldigt nära varandra. Efter det kommer CakePHP och sedan Zend.

På Coderseye.com gjorde de en undersökning bland sina prenumeranter där de fick över 7500 svar. Resultatet här stämde ganska bra överens med Google Trends. Laravel i toppen följt av Codeigniter och Symfony. Däremot kom Zend mycket högre upp här än i Google Trends. Yii 2 var här också nästan lika populärt som CakePHP.

Resultat verkar ganska tydligt, de tre mest populära ramverken är Laravel i toppen, följt av Codeigniter och Symfony. Resultatet stärks även av fler andra sidor som rangordnar ramverken likadant.

[Google Trends](https://trends.google.com/trends/explore?date=today%205-y&q=laravel,Symfony,Codeigniter,CakePHP,Zend)
[Coderseye.com](https://coderseye.com/best-php-frameworks-for-web-developers/)

###Berätta om din syn/erfarenhet generellt kring communities och specifikt communities inom opensource och programmeringsdomänen.
Jag har en väldigt bra erfarenhet av opensource-communities trots att jag själv kanske inte är den mest aktiva. Jag upplever att människor är väldigt hjälpsamma, vill dela med sig av sin kod och kunskap. En bra och stark community är viktigt för att ett opensource-projekt verkligen ska lyckas och inte dö ut.

Dbwebb är ju faktiskt ett exempel på en bra community. Du kan snabbt få hjälp via chatt eller forum. Dbwebb är nog en community jag själv kommer fortsätta att vara kvar i även efter avslutade studier.

###Vad tror du om begreppet “en ramverkslös värld” som framfördes i videon?
Jag gillar begreppet “en ramverkslös värld”, att slippa “stänga in dig” i ett ramverk där det finns alldeles för många moduler som du kanske inte använder. Däremot ser jag inget fel med att använda ramverk. Att ha allt “färdigt” från början gör ju faktiskt ditt jobb mycket enklare och bekvämare. Du slipper göra vissa val om vad du ska göra och hur du ska göra det.

Som sagt jag gillar begreppet, men samtidigt gillar ramverks-idén. Välj väg utifrån det som passar dig och ditt projekt.

###Hur gick dina förberedelser inför kommentarssystemet?
Jag har förberett mig mentalt och tänkt lite på databasstrukturen till ett Stackoverflow-system. En fråga skapas. En fråga kan ha flera kommentarer. Någon kopplingstabell mellan fråga och kommentarer. Frågor kan även ha svar och svaren kan ha kommentarer. En användare kopplas till varje fråga, svar och kommentar. Det är väl grundstrukturen till systemet. Sedan lite andra små saker runt omkring som till exempel kategorier, poäng, med mera. Jag har gamla moduler för användare och login som nog går att återanvända. Däremot skulle jag vilja skriva om och fixa till dem lite.



---



##Kmom02

###Vilka tidigare erfarenheter har du av MVC? Använde du någon speciell källa för att läsa på om MVC? Kan du med egna ord förklara någon fördel med kontroller/modell-begreppet, så som du ser på det?
Kan inte säga att jag har några erfarenheter av MVC. Har hört talas om det innan och vetat på ett ungefär vad det innebär, dock aldrig använt det själv. Förutom artikeln på dbwebb, som jag tyckte var bra för att visa hur det fungerar inom webb-världen, så läste jag även en artikel på sitepoint.com. En helt okej artikel, men tycker den på dbwebb var bättre.

Den största fördelen jag ser är att det blir mycket lättare att dela upp koden för dig och/eller ditt team. Jag känner också att det faktiskt blir lättare att förstå, i alla fall när du väl har kommit in i tänket och lärt dig hur det fungerar.

###Kom du fram till vad begreppet SOLID innebar och vilka källor använde du? Kan du förklara SOLID på ett par rader med dina egna ord?
Det börjar klarna mer och mer. En artikel på https://scotch.io hjälpte mig att förstå det mer än bara videon och Wikipedia. Får fortsätta läsa om det och implementera det själv när jag kodar.

Som jag har förstått det så handlar SOLID om att skriva kod som är lättare att förstå, underhålla och utöka. Det ska vara många små klasser som endast har en uppgift och som är oberoende av varandra.

###Gick arbetet med REM servern bra och du lyckades integrera den i din me-sida?
Arbetet med REM-servern var inga problem. Tycker det var lätt att få den att fungera i min egna installation av Anax. Trots att det var en lätt uppgift så var den ändå bra. Den gav en ganska god inblick i hur man skriver i MVC-format, vilket underlättade kommentarsuppgfiten.

###Berätta om arbetet med din kommentarsmodul, hur långt har du kommit och hur tänker du?
För tillfället har jag gjort en prototyp där man kan skapa, redigera och ta bort kommentarer. Jag valde att jobba med sessions och inte direkt gå på databaser. Tar ett steg i taget då jag har en del andra saker att göra samtidigt. Jag fixade även till stylen lite det här kursmomentet då jag lade ner väldigt lite tid på det i föregående moment. Kanske inte syns så mycket, men det är en helt annan och bättre grund nu.




---



##Kmom03

###Hur känns det att jobba med begreppen kring dependency injection, service locator och lazy loading?
DI och SL är inget jag är särskilt bekant med. Jag tycker dock det har gått ganska bra att jobba med det i det här kursmomentet. Det blir ju lite klurigare att hålla koll på allt när det injectas hit och dit. Det är nog en vanesak och jag tror jag kommer känna annorlunda längre fram. Tror även jag ska läsa på ännu mer om det för att verkligen trycka in det så att man förstår.

Lazy loading är något jag har hört talas om inom JavaScript-världen. Där handlar det mycket om att ladda in till exempel bilder först när användaren har scrollat ner till själva bilden. Principen är väl densamma i PHP och det är ett smart sätt att förbättra prestandan.

###Hur känns det att göra dig av med beroendet till $app, blir $id bättre?
Det har inte varit några problem att byta ut `$app` mot `$id`. De fungerar ju ungefär på samma sätt men jag tror `$id` kommer bli bättre att använda. Tror att jag längre fram kommer tycka det blir ännu bättre med $id.

###Hur känns det att återigen göra refaktoring på din me-sida, blir det förbättringar på kodstrukturen, eller bara annorlunda?
Det känns bra med refaktoring av min me-sida. Det blev lite rörigt medan jag gjorde det, det var många olika filer att hålla koll på i början och det var lite konstigt. Nu efter att det är klart så känns det faktiskt riktigt bra. Strukturen känns bättre och mer genomtänkt trots att det blir lite mer kod.

I oophp-kursen kände jag att det alltid var något som saknades när det kom till kodstrukturen. Det var klumpigt, inte lika välstrukturerat och jag vill förbättra det, men visste inte hur. Nu vet jag vad det var och jag tror kmom04 kommer göra det ännu smidigare med databaser och formulär.

###Lyckades du införa begreppen kring DI när du vidareutvecklade ditt kommentarssystem?
Jag vidareutvecklade inte kommentarssystemet, mer om det i nästa fråga, jag refactor:ade endast så att systemet använder DI och de nya routsen. Det blev endel saker att hålla koll på. Vilken kod som skulle vart och vad som var tvunget att skrivas om. Det var lite knepigt men fick ändå ihop det ganska snabbt tycker jag.

###Påbörjade du arbetet (hur gick det) med databasmodellen eller avvaktar du till kommande kmom?
Då det här kursmomentet gick så snabbt och i nästa kursmoment hade jag ändå fått göra om ganska mycket, så påbörjade jag det inte alls. Istället hoppar jag direkt in i kmom04 på tisdagen. Får se om jag till och med lyckas få båda kursmomenten gjorde den här veckan.

###Allmänna kommentarer kring din me-sida och dess kodstruktur?
Strukturen upplever jag ha blivit mycket bättre jämfört med oophp och även första kursmomentet. Annars när det kommer till me-sidan så skulle jag väl kunna jobba mer på utseendet. Speciellt när det kommer till “responsivitet”. Det kommer efterhand, i värsta fall får det förbättras i projektet.




---



##Kmom04

###Hur gick det att integrera formulärhantering och databashantering i ditt kommentarssystem?
När jag skulle integrera formulärhanteringen så glömde jag starta sessionen vilket gjorde att det inte fungerade med felmeddelande. Efter lite onödigt lång tid hittade jag det och sen så fungerade allt som det var tänkt. Integrationen av databashanteringen gick helt smärtfritt och Book-exemplet fungerade sedan utan problem.

###Berätta om din syn på Active record och liknande upplägg, ser du fördelar och nackdelar?
Det ger en bra rörlighet när det kommer till olika typer av databaser. Du behöver inte kunna alla skillnader i SQL-syntaxen när du jobbar med ORM. Det är också ett väldigt smidigt och snabbt sätt att få upp fungerande CRUD och i de flesta ORM-lager fungerar “INSERT” och “UPDATE” på samma sätt. Jämfört med oophp-kursen så gick det 100 gånger snabbare att få upp ett fungerande CRUD här än utan Active Record.

Att jobba med ORM är långsammare än rå SQL och det kan vara svårare att optimera om databasfrågan tar lång tid. Vill du utföra komplicerade SQL-frågor så får du kanske lägga lite tid på att studera ORM-lagret för att hitta hur du ska göra. Detta märkte jag i oopython-kursen när vi jobbade med SQLAlchemy. Det fanns väldigt mycket funktionalitet, vilket gjorde det lite svårare att hitta. Att dokumentationen inte var den bästa förbättrade ju inte situationen heller.

###Utveckla din syn på koden du nu har i ramverket och din kommentars- och användarkod. Hur känns det?
Koden har blivit bättre och bättre för varje kursmoment. Det är dock först nu i kmom04 som jag har lagt till användare. Det jag tycker är svårast är att veta var det är “bäst” att lägga vissa grejer, speciellt nu när formulärhantering och databashantering kom till. Det blir väldigt många filer att hålla koll på och lätt lite rörigt. Trots det känns det som mycket bättre struktur jämfört med när vi gjorde liknande saker i oophp-kursen.

För tillfället har jag delat upp kommentarerna och användarna i två olika moduler. Användarmodulen har två kontroller-klasser, en modell och en hjälpklass. Hjälpklassen kontrollerar att användaren är inloggad och behörighetsnivå. Klassen används sedan även i kommentarsmodulen för att kontrollera om användaren får kommentera, redigera och ta bort.

Jag gissar på att jag behöver slå ihop det till en modul i kmom05?

###Om du vill, och har kunskap om, kan du även berätta om din syn på ORM och designmönstret Data Mapper som är närbesläktade med Active Record. Du kanske har erfarenhet av likande upplägg i andra sammanhang?
Innan det här kursmomentet hade jag inte någon koll på Data Mapper eller Active Record. Jag visste på ett ungefär vad ORM innebär då vi använde SQLAlchemy i oopython-kursen. Däremot visste jag inte att SQLAlchemy använde designmönstret Data Mapper. Som jag fattar det är den största skillnaden mellan de två olika designmönstrena att i Data Mapper så behöver inte objekten veta hur de sparas i databasen, vilket gör att de klasserna blir lättare och inte behöver ärva lika mycket. Ett lite striktare sätt att hantera det på.

###Vad tror du om begreppet scaffolding, kan det vara något att kika mer på?
Tror det kan vara ett smidigt sätt att bygga upp grunden till en hel eller delar av en sida via templates. Det påminner om att installera Wordpress, något jag har gjort ett par gånger. Jag känner också att det kommer vara något väldigt användbart i framtiden när jag utvecklar olika typer av hemsidor och webbappar.




---



##Kmom05

###Hur gick arbetet med att lyfta ut koden ur me-sidan och placera i en egen modul?
Jag valde att lyfta ut användardelen i en egen modul då jag redan hade det uppdelat i en kommentarsdel och en användardel. Sedan lyfte jag ut filerna rakt av utan att ändra något. Därefter plockade jag ut delar av config-filerna som behövdes. Detta gjorde jag sen till ett repo som jag installerade i en ny Anax-installation för att testa. I den nya installationen gjorde jag sen en länk för att kunna jobba direkt i modulen.

Det gick faktiskt väldigt smidigt att lyfta ut det till en egen modul. Det gällde bara att hitta och komma ihåg alla delar som skulle vara med för att det skulle fungera. Jag glömde till exempel bort att lägga till Anax\Database som en service i DI-containern. Annars fungerade allt direkt utan att jag behövde ändra något. Jag fixade dock till lite saker och anpassade det mer för att vara en separat modul.

###Flöt det på bra med GitHub och kopplingen till Packagist?
Att koppla GitHub-repot till Packagist var inga problem. Allt gick smärtfritt, mer kan jag inte säga om det. Det är bra att det är så lätt och smidigt att skapa en modul om man vill dela med sig av sin kod.

###Hur gick det att åter installera modulen i din me-sida med composer, kunde du följa din installationsmanual?
Jag testade först att installera den i en ny installation av Anax. När jag såg att det fungerade så vågade jag mig på att göra det i min Me-sida. Hade inga problem att följa min manual, tycker jag lyckades göra den ganska bra. Jag valde att göra ett ‘make’-kommando för att installera modulen automatiskt. I korta drag är det `composer require oenstrom/user` och sen `make install-module`. Om man vill så kan man göra en manuell installation, det står hur man gör det i manualen också. Det sista som behöver göras är att köra lite SQL-kod, sen är allt klart.

###Hur väl lyckas du enhetstesta din modul och hur mycket kodtäckning fick du med?
Jag tycker det var ganska svårt att enhetstesta modulen. Det är väldigt mycket beroenden hit och dit, vilket gör det mycket svårare. Det första jag vill enhetstesta var min User-klass och här kom första problemet, databas. Klassen extendar ActiveRecordModel och jag har ingen aning om hur jag ska testa det.

Efter ett antal svordomar kom jag fram till att jag borde kunna göra en Mock på DatabaseQueryBuilder.php som skickas in i User-klassen istället för den vanliga QueryBuildern. Så när User-klassen gör `->find()` så används min Mock-klass istället för den vanliga som hämtar data från databasen. Mock-klassen är inte den finaste men det fungerar och jag kunde testa hela User-klassen och få 100% kodtäckning i den.

Sedan gav jag mig på några av de andra klasserna och kom en bit på AuthHelper-klassen. Jag fick dock lite problem där som jag inte kunde lösa. Beroendena blev fler och tiden blev knapp så jag fick ge upp. När det kommer till kodstäckningen fick jag i alla fall totalt 14.63% av raderna och 31.03% av metoderna. Sen fick jag 100% i en klass och 60% i en annan. Det kunde ha varit värre...

###Några reflektioner över skillnaden med och utan modul?
Något som är lite svårare nu är att anpassa modulen mellan installationer. Visst går det att ändra i vendor-mappen, men det är ju inte optimalt. Helst så ska moduler vara väldigt fristående och lättanpassade. Min modul skulle behöva göras på ett annorlunda sätt och att ha åtta beroenden känns kanske inte heller så bra.




---



##Kmom06

###Har du någon erfarenhet av automatiserade tester och CI sedan tidigare?
Jag har endast lite erfarenhet av enhetstester sedan tidigare dbwebb-kurser och det är inte så mycket. Det var annorlunda och svårare att enhetstesta än det vi gjort tidigare. Många olika beroenden och databas gjorde det ju inte lättare.

###Hur ser du på begreppen, bra, onödigt, nödvändigt, tidskrävande?
Jag skulle nog säga bra men inte alltid nödvändigt. Det beror helt på situationen. Är det ett projekt du jobbar själv på och endast använder själv så känner jag att CI och tester inte alls är lika viktigt. Däremot så fort projektet växer och det blir fler utvecklare och större användarbas tror jag det kan vara bra saker att implementera. Du hittar problem snabbare och integrerar delar snabbare och lättare. Sen att jag inte tycker det är lika roligt att skriva enhetstester som själva koden som ska testas gör ju att man gärna undviker det.

Kom och tänka på podcasten jag lyssnade på här om dagen. Den handlar om hållbarhet och snabba lösningar. Påminde lite om den här frågan, kan vara värt en lyssning. [http://kodsnack.se/219/](http://kodsnack.se/219/)

###Hur stor kodtäckning lyckades du uppnå i din modul?
Jag fick väldigt mycket problem med testerna i det här kursmomentet. Ett error jag fick var “headers already sent”. Det gick att lösa genom “@runInSeparateProcess” i doc-blocken. Gjorde jag det fick jag istället problem med att sessionen inte fungerade lika bra. Det blev också problem med att assertions och kodtäckning inte dök upp om man körde i separat process.

Jag läste om ett liknande problem som fixades i version 6.0.X av PHPUnit, så jag testade att uppgradera. Då fick jag istället problem med att PHPUnit-klassen inte hittades. När jag väl hade löst det så upptäckte jag att den nyare versionen inte alls fixade problemet med assertions och kodtäckning. Istället fick jag något annat error som jag trodde berodde på PHPUnit 6.3.0 vilket gjorde att jag nedgraderade till 5.7 igen, något som inte hjälpte. Felet var dock inte så svårlöst och efter det så stannade jag kvar på 5.7.

Trots alla de här problemen och hur rörigt allt blev kom jag upp i 81 % kodtäckning enligt Scrutinizer. Vissa metoder som inte returnerade något visste jag inte exakt hur jag skulle testa så det blev att jag bara körde dem för att få kodtäckning. Färre beroenden och bättre uppdelad kod hade gjort allt lättare att testa. Något jag får tänka på i fortsättningen.

Precis innan jag skulle lämna in uppgiften testade jag en gång till med @runInSeparateProcess och nu fungerade det. Har inte ändrat något vad jag vet om och så helt plötsligt fungerar det. Så nu lyckades jag komma upp i 87 % kodtäckning enligt Scrutinizer.

###Berätta hur det gick att integrera mot de olika externa tjänsterna?
Det gick bra och det var väldigt lätt. Logga in, lägg till och så var det klart. Jag känner dock att Scrutinizer var mest genomtänkt. Det kändes lättare att hitta på deras sida jämfört med de andra.

###Vilken extern tjänst uppskattade du mest, eller har du förslag på ytterligare externa tjänster att använda?
Tjänsten jag uppskattade mest får nog bli Scrutinizer. Det känns som det mest kompletta verktyget. Du får det Travis och Circle ger plus kodtäckning, kodbetyg och förslag på förbättringar.




---



##Kmom10

Redovisningstext här.
