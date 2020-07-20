<?php

use App\Domain\Book\Actions\UploadAuthorPortraitImageAction;
use App\Domain\Book\Actions\UploadBookCoverImageAction;
use App\Domain\Book\Models\Author;
use App\Domain\Book\Models\Book;
use App\Domain\Book\Models\Genre;
use App\Domain\Book\Models\Nationality;
use App\Domain\Book\Models\Series;
use App\Domain\Book\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        File::copyDirectory(database_path('seeds/images'), database_path('seeds/temp'));

        $josephHeller = factory(Author::class)->create([
            'name' => 'Joseph Heller',
            'birth_date' => Carbon::parse('1923-05-01'),
            'death_date' => Carbon::parse('1999-12-12'),
            'biography' => 'Psal satirická díla, zejména novely a dramata.

J. Heller pocházel z Brooklynu v New Yorku, jeho rodiče byli židovští přistěhovalci z Ruska. Ve druhé světové válce sloužil u amerického bombardovacího letectva na Korsice.

V letech 1948–1949 studoval Columbijskou universitu v New Yorku, poté studoval v Anglii v Oxfordu.

Po ukončení studií pracoval v několika reklamních agenturách a věnoval se psaní. Roku 1975 se stal mimořádným profesorem literatury City College v New Yorku.',
            'nationality_id' => Nationality::whereName('americká')->firstOrFail(),
        ]);

        $this->addAuthorPortrait($josephHeller, 'joseph-heller.jpg');

        $seriesCatch22 = factory(Series::class)->create([
            'name' => 'Hlava XXII',
            'author_id' => $josephHeller,
        ]);

        $bookCatch22 = factory(Book::class)->create([
            'name' => 'Hlava XXII',
            'original_name' => 'Catch-22',
            'description' => 'Klasický protiválečný román. Autor v knize popsal osud hlavního hrdiny Yossariana a jeho letky bombardérů útočících na Itálii. Autor vychází ze svých vlastních zkušeností a svou prózou předznamenal to, co v americké kultuře naplno otevřela vietnamská válka o pětadvacet let později.',
            'release_year' => '1961',
            'author_id' => $josephHeller,
            'series_id' => $seriesCatch22,
        ]);

        $this->addBookCover($bookCatch22, 'catch-22.jpg');

        $bookCatch22->genres()->saveMany([
            Genre::firstOrCreate(['name' => 'Literatura světová']),
            Genre::firstOrCreate(['name' => 'Romány']),
            Genre::firstOrCreate(['name' => 'Válečné']),
        ]);

        $bookCatch22->tags()->saveMany([
            Tag::firstOrCreate(['name' => 'druhá světová válka (1939–1945)']),
            Tag::firstOrCreate(['name' => 'letectví']),
            Tag::firstOrCreate(['name' => 'zfilmováno']),
            Tag::firstOrCreate(['name' => 'vojenští letci']),
            Tag::firstOrCreate(['name' => 'americká literatura']),
            Tag::firstOrCreate(['name' => 'zfilmováno – TV seriál']),
        ]);

        $bookClosingTime = factory(Book::class)->create([
            'name' => 'Zavíráme!',
            'original_name' => 'Closing Time',
            'description' => 'Po třiatřiceti letech, po explozivním vstupu Hlavy XXII do světového kulturního povědomí vyhoví Heller prosbám čtenářů a napíše obsáhlé volné pokračování své nejslavnější první práce, kterou nazve Zavíráme. Opět se setkáváme s hlavním hrdinou Hlavy XXII Yossarianem, který v 80. letech spolu s dalšími postavami nakoukne do novodobé válečné mašinérie.',
            'release_year' => '1994',
            'author_id' => $josephHeller,
            'series_id' => $seriesCatch22,
        ]);

        $this->addBookCover($bookClosingTime, 'closing-time.jpg');

        $bookClosingTime->genres()->saveMany([
            Genre::firstOrCreate(['name' => 'Literatura světová']),
            Genre::firstOrCreate(['name' => 'Romány']),
        ]);

        $bookClosingTime->tags()->saveMany([
            Tag::firstOrCreate(['name' => 'americká literatura']),
            Tag::firstOrCreate(['name' => 'satira']),
        ]);

        $bookCatchAsCatchCan = factory(Book::class)->create([
            'name' => 'Hlava nehlava: Sebrané povídky a jiné texty',
            'original_name' => 'Catch as Catch Can: The Collected Stories and Other Writings',
            'description' => 'Kniha shromažďuje veškeré povídky slavného amerického spisovatele včetně textů dosud nezveřejněných, a významně tak doplňuje obraz jeho celoživotní tvorby.

Svazek obsahuje nejen povídky z doby po 2. světové válce, ať již nevydané, nebo časopisecky publikované, ale také autorskou dramatizaci významné pasáže z Hlavy XXII (jednoaktovka Soud s Clevingerem) a kratší prózy, týkající se vzniku tohoto románu a ohlasů na něj. Závěr knihy patří vzpomínkám na Coney Island, kde Heller prožil dětství a mládí a které později zpracoval v autobiografii Tady a teď.',
            'release_year' => '2003',
            'author_id' => $josephHeller,
            'series_id' => $seriesCatch22,
        ]);

        $this->addBookCover($bookCatchAsCatchCan, 'catch-as-catch-can.jpg');

        $bookCatchAsCatchCan->genres()->saveMany([
            Genre::firstOrCreate(['name' => 'Literatura světová']),
            Genre::firstOrCreate(['name' => 'Romány']),
        ]);

        $bookCatchAsCatchCan->tags()->saveMany([
            Tag::firstOrCreate(['name' => 'americká literatura']),
            Tag::firstOrCreate(['name' => 'satira']),
        ]);

        $saintExupery = factory(Author::class)->create([
            'name' => 'Antoine de Saint-Exupéry',
            'birth_date' => Carbon::parse('1900-06-29'),
            'death_date' => Carbon::parse('1944-07-31'),
            'biography' => 'Celým jménem Antoine-Jean-Babtiste-Marie-Roger de Saint-Exupéry, narodil se v Lyonu a tragicky zahynul v létě 1944, patrně sestřelen německým letadlem v prostoru Korsiky nebo nad Alpami.

Jeho život i tvorba jsou mimořádně sourodé, obojí určuje Saint-Exupéryho povolání letce, ale i psychické založení hluboce citlivého a ušlechtilého člověka. Po studiu na Námořní škole, které ho nijak nenadchlo, sloužil jako voják u letectva, kde propukla jeho vášeň pro létání. Jako pilot byl zaměstnán u vícero leteckých společností a létal na různých linkách. Exotická prostředí, v nichž se ocitají jeho letečtí hrdinové, důvěrně znal, neboť se pohyboval na linkách Toulouse-Dakar, Casablanka-Timbuktu, Buenos Aires-Ohňová země; pokusil se i o rekordní lety a několikrát havaroval. Po vypuknutí 2. světové války si doslova vynutil vstup do řad válečných pilotů, který mu byl pro jeho věk odpírán. Jeho dvacetiletou leteckou dráhu završila tragická smrt, která jeho život i dílo korunovala heroickou slávou.

Saint-Exupéryho literární dílo je apoteózou mravních hodnot člověka. Třebaže skeptik, prožívající trvalou bolestnou úzkost ze zmechanizované, odlidštěné civilizace, neustále osvědčuje optimistickou víru v to nejlepší v člověka i v lidském společenství. Jeho dílo, pateticky vášnivé a myšlenkově hluboké, vzbudilo už od prvních knih živý čtenářský ohlas. Po novele Letec vydal romány Kurýr na jih, Noční let, Země lidí (s ústředním motivem ztroskotání nad pouští, které zažil na vlastní kůži) aj. Velmi známá je jeho básnická pohádka Malý princ. Některá díla (Citadela, Dopis rukojmímu, deníky, korespondence atd.) vyšla až po autorově smrti.',
            'nationality_id' => Nationality::whereName('francouzská')->firstOrFail(),
        ]);

        $this->addAuthorPortrait($saintExupery, 'saint-exupery.jpg');

        $bookLePetitPrince = factory(Book::class)->create([
            'name' => 'Malý princ',
            'original_name' => 'Le Petit Prince',
            'description' => 'Není princ jako princ. Tenhle je skutečně jen jeden – Malý princ Antoina de Saint-Exuperyho, jedno z nejslavnějších děl moderní světové literatury.

Malý princ, kouzelná pohádková bytost, přichází na naši Zemi ze vzdálených vesmírných světů, aby se kdesi v Africké poušti setkal s autorem našeho příběhu a zjevil mu tajemství své podivuhodné životní pouti. Ale zjeví mu vlastně daleko víc: tajemství čistého srdce, dobra a krásy. Je to opravdu líbezná knížka, která vám bude jistě právě tak milá a blízká, jako byla všem čtenářským generacím, a k níž se budete i později najednou rádi vracet.',
            'release_year' => '1943',
            'author_id' => $saintExupery,
        ]);

        $this->addBookCover($bookLePetitPrince, 'le-petit-prince.jpg');

        $bookLePetitPrince->genres()->saveMany([
            Genre::firstOrCreate(['name' => 'Literatura světová']),
            Genre::firstOrCreate(['name' => 'Novely']),
            Genre::firstOrCreate(['name' => 'Pro děti a mládež']),
        ]);

        $bookLePetitPrince->tags()->saveMany([
            Tag::firstOrCreate(['name' => 'Malý princ']),
            Tag::firstOrCreate(['name' => 'francouzská literatura']),
            Tag::firstOrCreate(['name' => 'vesmír']),
            Tag::firstOrCreate(['name' => 'děti']),
            Tag::firstOrCreate(['name' => 'dětský hrdina']),
            Tag::firstOrCreate(['name' => 'zfilmováno']),
        ]);

        $stiegLarsson = factory(Author::class)->create([
            'name' => 'Stieg Larsson',
            'birth_date' => Carbon::parse('1954-08-15'),
            'death_date' => Carbon::parse('2004-11-09'),
            'biography' => 'Stieg Larsson (15. srpna 1954 až 9. listopadu 2004) byl švédský novinář a spisovatel. Narodil se nedaleko města Skellefteå v severním Švédsku. Jeho rodiče byli příliš mladí, a tak Stieg vyrůstal u svých prarodičů v malé vesničce na severu Švédska. Severin Boström, Stiegův dědeček, se pro malého Stiega stal významným mužským vzorem. Severin Boström byl přesvědčený antifašista, během druhé světové války byl kvůli svým protinacistickým názorům uvězněn v pracovním táboře Storsien. Kdyby byl dánské národnosti, bezpochyby by skončil v koncentračním táboře. Osud tohoto muže hluboce ovlivnil Stiegův charakter. Snažil se chránit rovná práva pro všechny a bojovat za demokracii a svobodu projevu.

Když bylo Stiegovi devět let, jeho dědeček zemřel a on začal žít s rodiči a s mladším bratrem. Ke dvanáctým narozeninám dostal psací stroj. Často pak trávil celé noci psaním a klapání psacího stroje probouzelo celou rodinu. Když mu bylo osmnáct, zúčastnil se v Umeå mítinku proti válce ve Vietnamu. Tam potkal Evu Gabrielssonovou, svou životní partnerku.

Stieg Larsson se po absolvování vojenské služby vydal na cesty po Africe. Jen zřídka měl dost peněz na cestování, jeho otec v jednom rozhovoru dokonce uvádí, že na zpáteční letenku z Alžíru si musel vydělat mytím nádobí a prodat své šaty. Pracoval na poštovním úřadě a zároveň byl aktivním členem švédského levicového hnutí, které v té době prožívalo rozkvět. Velice se zajímal o právě probíhající válku ve Vietnamu. V letech 1977 až 1999 pracoval jako designér pro největší švédskou tiskovou kancelář TT. Pracoval také jako skandinávský korespondent britského antifašistického magazínu Searchlight. Byl také znám také jako jeden z největších švédských fanoušků sci-fi literatury. Mimo jiné byl předsedou Skandinávské společnosti sci-fi a vydával dva časopisy.

Boj proti extremismu

Počátkem osmdesátých let se Stieg Larsson začal stále více angažovat v boji proti rasismu a pravicovému extremismu a také o švédském pravicovém extremistickém hnutí psal. V roce 1991 vydal svou první knihu Extremhögern (Pravicový extremismus). Napsal ji spolu s Annou-Lenou Lodeniusovou, švédskou spisovatelkou, která se rovněž problémem extremismu zabývala. Jeden neonacistický deník jako odpověď na tuto knihu publikoval v roce 1993 článek, jehož součástí byly i fotografie Larssona a Lodeniusové, jejich adresy a osobní telefonní čísla. Zároveň pokládal otázku, zda „je dobré jim dovolit pokračovat v práci, nebo by se mělo něco podniknout“. Vydavatel časopisu byl následně odsouzen ke čtyřem měsícům vězení. Tato událost však Stiega Larssona od další práce neodradila, právě naopak. Přesvědčila ho, že je třeba proti rasismu, extremismu a podobným hnutím bojovat.

Expo

Novinářské zkušenosti a politické přesvědčení vedlo Stiega Larssona v devadesátých letech k založení nadace Expo, jejímž cílem bylo sledování a dokumentace rasistických a nedemokratických tendencí ve švédské společnosti. Larsson se také stal vydavatelem stejnojmenného časopisu. V polovině devadesátých let pomáhal iniciovat projekt „Stop rasismu“. Brzy proslul jako odborník na švédské krajně pravicové a rasistické organizace, vystupoval často na veřejnosti a celá léta musel čelit více či méně vážným výhrůžkám ze strany svých politických nepřátel.

Dlouholeté soužití Stiega Larssona a Evy Gabrielssonové bylo těmito permanentními hrozbami značně poznamenáno. Když byl v roce 1999 neonacisty ve svém domě zavražděn hlavní představitel švédských odborů, policie na místě činu objevila fotografie a informace o Stiegovi a Evě. Oba se proto rozhodli přijmout radikální bezpečnostní opatření. Přestali se spolu ukazovat na veřejnosti, zatahovali rolety, do haly nainstalovali systém zrcadel. Stieg byl v tomto ohledu odborník, pro Švédskou unii novinářů dokonce napsal knihu o tom, jak by se novináři měli bránit hrozbám (Överleva Deadline, 2000). S malými přestávkami spolu Stieg a Eva žili až do jeho smrti.

Stieg Larsson zemřel roku 2004 ve Stockholmu na těžký infarkt. Domněnky, podle nichž jeho smrt jakýmsi způsobem souvisela s výhrůžkami, jimž musel čelit coby vydavatel Expa, se nakonec nepotvrdily. Přestože se Stieg Larsson mezinárodního úspěchu svého literárního díla nedožil, je nepochybné, že se jedná o jeden z největších objevů posledního desetiletí. Trilogie Milénium dalece přesahuje rozměr klasického detektivního žánru — šíří a hloubkou svého záběru připomíná spíše nesmírně rozmanitou a plastickou fresku současné společnosti.',
            'nationality_id' => Nationality::whereName('švédská')->firstOrFail(),
        ]);

        $this->addAuthorPortrait($stiegLarsson, 'stieg-larsson.jpg');

        $seriesMillenium = factory(Series::class)->create([
            'name' => 'Milénium',
            'author_id' => $stiegLarsson,
        ]);

        $bookManSomHatarKvinnor = factory(Book::class)->create([
            'name' => 'Muži, kteří nenávidí ženy',
            'original_name' => 'Män som hatar kvinnor',
            'description' => 'Novinář Mikael Blomkvist má za úkol vyšetřit starý kriminální případ: Harriet Vangerová, vnučka průmyslníka Vangera, zmizela beze stopy téměř před čtyřiceti lety. Blomkvist se seznámí s Lisbeth Salanderovou, mladou svéhlavou ženou, nepřekonatelnou hackerkou, která se stane pro jeho pátrání nepostradatelnou. Blomkvist a Salanderová tvoří neobvyklý pár, ale dokonalý tým. Společně začnou brzy rozkrývat temnou a krvavou rodinnou historii. Trilogie Milénium nové hvězdy švédské kriminální literatury Stiega Larssona sklidila ihned po svém vydání mimořádný úspěch u čtenářů i kritiky.',
            'release_year' => '2005',
            'author_id' => $stiegLarsson,
            'series_id' => $seriesMillenium,
        ]);

        $this->addBookCover($bookManSomHatarKvinnor, 'man-som-hatar-kvinnor.jpg');

        $bookManSomHatarKvinnor->genres()->saveMany([
            Genre::firstOrCreate(['name' => 'Literatura světová']),
            Genre::firstOrCreate(['name' => 'Detektivky']),
            Genre::firstOrCreate(['name' => 'Krimi']),
            Genre::firstOrCreate(['name' => 'Thrillery']),
        ]);

        $bookManSomHatarKvinnor->tags()->saveMany([
            Tag::firstOrCreate(['name' => 'zfilmováno']),
            Tag::firstOrCreate(['name' => 'sérioví vrazi']),
            Tag::firstOrCreate(['name' => 'hackeři']),
            Tag::firstOrCreate(['name' => 'švédské detektivky']),
            Tag::firstOrCreate(['name' => 'detektivky']),
            Tag::firstOrCreate(['name' => 'krimi']),
        ]);

        $bookFlickanSomLekteMedElden = factory(Book::class)->create([
            'name' => 'Dívka, která si hrála s ohněm',
            'original_name' => 'Flickan som lekte med elden',
            'description' => 'Dva novináři časopisu Milénium jsou zavražděni krátce před publikováním článku o dětské prostituci, korupci a obchodu s bílým masem. Na zbrani nalezené na místě činu se najdou otisky Salanderové a její poručník je brzy nalezen mrtvý. Policie po údajné pachatelce zahájí celostátní pátrání podporované mediální kampaní, ve které se vytahují na světlo skandální informace o její potenciální nebezpečnosti a problematické minulosti. Mikael Blomkvist je však přesvědčen o její nevině...
Trilogie Milénium nové hvězdy švédské kriminální literatury Stiega Larssona sklidila ihned po svém vydání mimořádný úspěch u čtenářů i kritiky. Podle žebříčku patnácti celosvětově nejprodávanějších titulů za rok 2008, který jako každý leden sestavil newyorský měsíčník Publishing Trends, se Stieg Larsson s prvním dílem své trilogie umístil na třetí příčce, druhým na devátém a třetím na desátém místě, a stal se tak celkově nejúspěšnějším autorem žebříčku',
            'release_year' => '2006',
            'author_id' => $stiegLarsson,
            'series_id' => $seriesMillenium,
        ]);

        $this->addBookCover($bookFlickanSomLekteMedElden, 'flickan-som-lekte-med-elden.jpg');

        $bookFlickanSomLekteMedElden->genres()->saveMany([
            Genre::firstOrCreate(['name' => 'Literatura světová']),
            Genre::firstOrCreate(['name' => 'Detektivky']),
            Genre::firstOrCreate(['name' => 'Krimi']),
            Genre::firstOrCreate(['name' => 'Thrillery']),
        ]);

        $bookFlickanSomLekteMedElden->tags()->saveMany([
            Tag::firstOrCreate(['name' => 'zfilmováno']),
            Tag::firstOrCreate(['name' => 'sérioví vrazi']),
            Tag::firstOrCreate(['name' => 'hackeři']),
            Tag::firstOrCreate(['name' => 'švédské detektivky']),
            Tag::firstOrCreate(['name' => 'detektivky']),
            Tag::firstOrCreate(['name' => 'krimi']),
        ]);

        $bookLuftslotterSomSprangdes = factory(Book::class)->create([
            'name' => 'Dívka, která kopla do vosího hnízda',
            'original_name' => 'Luftslotter som sprängdes',
            'description' => 'Dva těžce zranění lidé byli přijati na pohotovost v nemocnici v Gotheburgu. Jedna z nich je hledaná vražedkyně Lisbeth Salanderová s kulkou v hlavě, která potřebuje okamžitou pomoc, druhá osoba je Alaxander Zalaščenko, starší muž, kterého Lisbeth napadla sekerou.
Ve třetí části trilogie Millenium Lisbeth Salanderová osnuje pomstu - proti muži, který ji chtěl zabít, a což je důležitější, proti vládním institucím, které jí málem zničily život. Nic nebude tak jednoduché, jak se to jevilo ze začátku, někdo tentokrát sleduje ji. Také se musí zbavit obvinění z vraždy, které jí visí nad hlavou.
Podle úspěšného vzoru minulých knih potřebuje pomoc novináře Mikaela Blomkvista.
Konec přínáší pro Lisbeth šanci zbavit se tíživé minulosti a naději, že pravda a spravedlnost zvítězí.',
            'release_year' => '2007',
            'author_id' => $stiegLarsson,
            'series_id' => $seriesMillenium,
        ]);

        $this->addBookCover($bookLuftslotterSomSprangdes, 'luftslotter-som-sprangdes.jpg');

        $bookLuftslotterSomSprangdes->genres()->saveMany([
            Genre::firstOrCreate(['name' => 'Literatura světová']),
            Genre::firstOrCreate(['name' => 'Detektivky']),
            Genre::firstOrCreate(['name' => 'Krimi']),
            Genre::firstOrCreate(['name' => 'Thrillery']),
        ]);

        $bookLuftslotterSomSprangdes->tags()->saveMany([
            Tag::firstOrCreate(['name' => 'zfilmováno']),
            Tag::firstOrCreate(['name' => 'sérioví vrazi']),
            Tag::firstOrCreate(['name' => 'hackeři']),
            Tag::firstOrCreate(['name' => 'švédské detektivky']),
            Tag::firstOrCreate(['name' => 'detektivky']),
            Tag::firstOrCreate(['name' => 'krimi']),
            Tag::firstOrCreate(['name' => 'poslední kniha autora']),
        ]);

        File::deleteDirectory(database_path('seeds/temp'));
    }

    protected function addAuthorPortrait(Author $author, string $fileName): void
    {
        (new UploadAuthorPortraitImageAction())->execute(
            $author,
            new UploadedFile(
                database_path(sprintf('seeds/temp/authors/%s', $fileName)),
                'image/jpeg'
            )
        );
    }

    protected function addBookCover(Book $book, string $fileName): void
    {
        (new UploadBookCoverImageAction())->execute(
            $book,
            new UploadedFile(
                database_path(sprintf('seeds/temp/books/%s', $fileName)),
                'image/jpeg'
            )
        );
    }
}
