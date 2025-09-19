<style>
    
    /* Notification container */
    .notification-container {
      position: fixed;
      bottom: 80px;
      right: 20px;
      width: 300px;
      z-index: 9999;
    }

    /* Individual notification */
    .notification {
      background-color: var(--hover-clr);
      color: var(--text-clr);
      padding: 10px 5px;
      margin-top: 10px;
      border-radius: 6px;
      box-shadow: 0 3px 10px rgba(0, 0, 0, 0.2);
      display: flex;
      align-items: center;
      transform: translateX(120%);
      opacity: 0;
      transition: transform 1.5s ease, opacity 1.5s ease;
      cursor: grab;
      user-select: none;
      touch-action: pan-y;
      position: relative;
      /* border: 1px solid var(--line-clr); */
    }

    .notification.show {
      transform: translateX(0);
      opacity: 1;
    }

    .notification.hide {
      transform: translateX(120%);
      opacity: 0;
    }

    .notification.swiping {
      transition: transform 0.1s ease;
    }

    .notification-icon {
      background-color: #4CAF50;
      color: white;
      width: 40px;
      height: 40px;
      border-radius: 50%;
      display: flex;
      justify-content: center;
      align-items: center;
      margin-right: 15px;
      margin-left: 6px;
      flex-shrink: 0;
    }

    .notification-content {
      flex-grow: 1;
    }

    .notification-title {
      font-weight: bold;
      font-size: 14px;
      margin-bottom: 5px;
    }

    .notification-message {
      font-size: 13px;
      color: var(--secondary-text-clr);
    }

    .notification-time {
      font-size: 11px;
      color: var(--line-clr);
      margin-top: 5px;
    }

    .swipe-hint {
      position: absolute;
      right: 10px;
      top: 50%;
      transform: translateY(-50%);
      /* color: #ccc; */
      font-size: 12px;
      opacity: 0.7;
    }
</style>
<div class="notification-container" id="notification-container"></div>
<script src="/chain-fortune/js/earning_alert.js"></script>
 <script>
  const names = [
    "Emma", "Noah", "Olivia", "Liam", "Ava", "William", "Sophia", "Mason", "Isabella", "James",
    "Charlotte", "Elijah", "Amelia", "Oliver", "Mia", "Benjamin", "Harper", "Lucas", "Evelyn", "Alexander",
    "Abigail", "Henry", "Emily", "Sebastian", "Elizabeth", "Aiden", "Sofia", "Samuel", "Avery", "Matthew",
    "Ella", "David", "Scarlett", "Joseph", "Grace", "Carter", "Chloe", "Owen", "Victoria", "Wyatt",
    "Riley", "John", "Aria", "Jack", "Lily", "Luke", "Aubrey", "Jayden", "Zoey", "Dylan",
    "Hannah", "Grayson", "Layla", "Levi", "Nora", "Isaac", "Zoe", "Gabriel", "Leah", "Julian",
    "Audrey", "Mateo", "Savannah", "Muhammad", "Brooklyn", "Lincoln", "Bella", "Anthony", "Claire", "Joshua",
    "Skylar", "Andrew", "Lucy", "Ryan", "Paisley", "Jaxon", "Everly", "Nathan", "Anna", "Aaron",
    "Caroline", "Isaiah", "Nova", "Thomas", "Genesis", "Charles", "Emilia", "Caleb", "Kennedy", "Josiah",
    "Samantha", "Christian", "Maya", "Hunter", "Willow", "Eli", "Kinsley", "Jonathan", "Naomi", "Connor",
    "Aaliyah", "Landon", "Elena", "Adrian", "Sarah", "Asher", "Ariana", "Cameron", "Allison", "Leo",
    "Gabriella", "Theodore", "Alice", "Jeremiah", "Madelyn", "Hudson", "Cora", "Robert", "Ruby", "Easton",
    "Eva", "Nolan", "Serenity", "Nicholas", "Autumn", "Ezra", "Adeline", "Colton", "Hailey", "Angel",
    "Gianna", "Brayden", "Valentina", "Jordan", "Isla", "Dominic", "Eliana", "Austin", "Quinn", "Ian",
    "Nevaeh", "Adam", "Ivy", "Elias", "Sadie", "Jaxson", "Piper", "Greyson", "Lydia", "Jose",
    "Alexa", "Ezekiel", "Josephine", "Carson", "Emery", "Evan", "Julia", "Maverick", "Delilah", "Bryson",
    "Arianna", "Jace", "Vivian", "Cooper", "Kaylee", "Xavier", "Sophie", "Parker", "Brielle", "Roman",
    "Madeline", "Jason", "Peyton", "Santiago", "Rylee", "Chase", "Clara", "Sawyer", "Hadley", "Gavin",
    "Melanie", "Leonardo", "Mackenzie", "Kayden", "Reagan", "Ayden", "Adalynn", "Jameson", "Liliana", "Kevin",
    "Aubree", "Bentley", "Jade", "Zachary", "Katherine", "Everett", "Isabelle", "Axel", "Natalia", "Tyler",
    "Raelynn", "Micah", "Maria", "Vincent", "Stella", "Weston", "Lyla", "Miles", "Hazel", "Wesley",
    "Callie", "Nathaniel", "Violet", "Harrison", "Aurora", "Brandon", "Emerson", "Cole", "Jordyn", "Declan",
    "Adelyn", "Luis", "Mary", "Braxton", "Lilly", "Damian", "London", "Silas", "Paige", "Tristan",
    "Ariel", "Ryder", "Elise", "Bennett", "Alaina", "George", "Harmony", "Emmett", "Kylie", "Justin",
    "Athena", "Kai", "Leilani", "Max", "Alexandra", "Diego", "Lila", "Luca", "Molly", "Ryker",
    "Khloe", "Carlos", "Taylor", "Maxwell", "Natalie", "Kingston", "Kayla", "Ivan", "Alexis", "Maddox",
    "Jasmine", "Juan", "Morgan", "Ashton", "Teagan", "Jayce", "Eden", "Rowan", "Brianna", "Kaiden",
    "Mariah", "Giovanni", "Faith", "Eric", "Rose", "Jesus", "Margaret", "Calvin", "Daisy", "Abel",
    "Zuri", "King", "Reese", "Amir", "Eliza", "Blake", "Iris", "Alex", "Arabella", "Brody",
    "Alana", "Malachi", "Genevieve", "Emmanuel", "Aliyah", "Jonah", "Londyn", "Beau", "Juliana", "Jude",
    "Morgan", "Antonio", "Summer", "Alan", "Juliette", "Elliott", "Tessa", "Elliot", "Daleyza", "Waylon",
    "Maggie", "Xander", "Ana", "Timothy", "Lucia", "Victor", "Myla", "Bryce", "Kimberly", "Finn",
    "Charlie", "Brantley", "Camille", "Edward", "Noelle", "Abraham", "Amaya", "Patrick", "Cecilia", "Grant",
    "Catalina", "Karter", "Daphne", "Hayden", "Lilah", "Richard", "Ruth", "Miguel", "Adalyn", "Joel",
    "Allie", "Gael", "Eloise", "Tucker", "Laila", "Rhett", "Brooklynn", "Avery", "Gracie", "Steven",
    "Norah", "Graham", "Angelina", "Kaleb", "Joy", "Jasper", "Mckenzie", "Jesse", "Kendall", "Matteo",
    "Kenzie", "Dean", "Maci", "Zayden", "Sawyer", "Zion", "Everlee", "Jax", "Rowan", "Cedric",
    "Payton", "Jake", "Marley", "Riley", "Madilyn", "Archer", "June", "Legend", "Harlow", "Killian",
    "Adelynn", "Seth", "Charlee", "Atticus", "Lucille", "Leon", "Vivienne", "Myles", "Danielle", "August",
    "Presley", "Mark", "Camila", "Sean", "Daniela", "Maximus", "Oakley", "Kaden", "Octavia", "Caden",
    "Oaklynn", "Paxton", "Olive", "Knox", "Finley", "Nash", "Mckenna", "Beckham", "Fiona", "Jett",
    "Miracle", "Omar", "Hallie", "Simon", "Jayla", "Kash", "Leila", "Jeremy", "Ashley", "Preston",
    "Aniyah", "Oscar", "Gabrielle", "Matias", "Nicole", "Messiah", "Nia", "Emiliano", "Sutton", "Enzo",
    "Georgia", "Jaden", "Selena", "Colt", "Rosalie", "Jaylen", "Sloane", "Kian", "Amara", "Atlas",
    "Wren", "Remington", "Phoebe", "Cohen", "Amira", "Joaquin", "Willa", "Brady", "Ember", "Tate",
    "Joanna", "Ace", "Melissa", "Eduardo", "Juniper", "Lukas", "Journee", "Dawson", "Remi", "Peter",
    "Brynn", "Kameron", "Dulce", "Maximiliano", "Mabel", "Cayden", "Cali", "Jaiden", "Blair", "Iker",
    "Oaklyn", "Holden", "Elliana", "Griffin", "Kathryn", "Arthur", "Juliet", "Paul", "Sienna", "Brian",
    "Alaya", "Cody", "Charli", "Andres", "Winnie", "Ari", "Haven", "Gideon", "Millie", "Zane",
    "Rachel", "Travis", "Alani", "Francisco", "Amy", "Marcus", "Harley", "Josue", "Rebecca", "Beckett",
    "Annabelle", "Javier", "Raegan", "Jase", "Collins", "Dante", "Michelle", "Kyrie", "Gracelynn", "Corbin",
    "Kali", "Jeffrey", "Madeleine", "Bodhi", "Ayla", "Colin", "Angela", "Lorenzo", "Braelynn", "Gideon",
    "Emersyn", "Adriel", "Esther", "Cade", "Elaina", "Judah", "Gracelyn", "Derek", "Gia", "Rafael",
    "Brooke", "Conor", "Maisie", "Thiago", "Vera", "Felix", "Alicia", "Titus", "Lena", "Phillip",
    "Julianna", "Donovan", "Kelsey", "Khalil", "Nyla", "Raymond", "Tatum", "Armani", "Francesca", "Johnathan",
    "Wynter", "Mathias", "Malia", "Erik", "Maeve", "Orion", "Alessandra", "Spencer", "Evangeline", "Ricardo",
    "Shiloh", "Quinn", "Paola", "Theo", "Selah", "Martin", "Sage", "Garrett", "Rosemary", "Nico",
    "Jolene", "Tyson", "Hadlee", "Fernando", "Marilyn", "Keaton", "Dallas", "Hector", "Mariana", "Cash",
    "Kamila", "Cruz", "Mallory", "Chance", "Esmeralda", "Cristian", "Alayna", "Nehemiah", "Angelica", "Jared",
    "Lexi", "Cyrus", "Raelyn", "Emerson", "Royalty", "Lane", "Liana", "Angelo", "Melany", "Ronan",
    "Chelsea", "Cristiano", "Jimena", "Aziel", "Aileen", "Callum", "Lilith", "Philip", "Dahlia", "Tobias",
    "Logan", "Damien", "Amiyah", "Crew", "Wrenley", "Zayn", "Kassidy", "Malcolm", "Averie", "Amari",
    "Lorelei", "Gunner", "Rosie", "Carmelo", "Maddison", "Royce", "Palmer", "Kolton", "Thea", "Roberto",
    "Talia", "Wade", "Mara", "Fabian", "Evelynn", "Landen", "Brinley", "Lawson", "Celine", "Hendrix",
    "Maryam", "Zayne", "Heidi", "Kyler", "Esme", "Tatum", "Phoenix", "Kyle", "Vada", "Milo",
    "Poppy", "Daxton", "Colette", "Skyler", "Bianca", "Damon", "Noa", "Devin", "Noor", "Dax",
    "Addyson", "Dariel", "Kamryn", "Kylan", "Zariah", "Alonzo", "Elsa", "Leonel", "Skye", "Ayaan",
    "Emelia", "Santino", "Sunny", "Benson", "Estrella", "Moses", "Fatima", "Noe", "Mina", "Uriel",
    "Saylor", "Kasen", "Veronica", "Camilo", "Keira", "Sylas", "Chaya", "Walter", "Karsyn", "Allen",
    "Samara", "Kobe", "Alayah", "Adan", "Briella", "Rayan", "Abby", "Keegan", "Annalise", "Ares",
    "Leighton", "Darius", "Lyra", "Drake", "Anaya", "Sergio", "Azalea", "Izaiah", "Addisyn", "Colson",
    "Ailani", "Shawn", "Amanda", "Adonis", "Holly", "Conner", "Belle", "Axton", "Miranda", "Lennon",
    "Josie", "Troy", "Kaitlyn", "Aaden", "Marlee", "Dayton", "Lainey", "Jonas", "Jillian", "Jaxton",
    "Lennox", "Tripp", "Mira", "Casen", "Whitney", "Alexis", "Michaela", "Karson", "Nathalie", "Lucian",
    "Aviana", "Marcelo", "Priscilla", "Aarav", "Ciara", "Hamza", "Lilliana", "Alec", "Lacey", "Koa",
    "Lia", "Madden", "Rowan", "Kieran", "Mikayla", "Dorian", "Skyla", "Trey", "Monica", "Eliel",
    "Aspen", "Jamir", "Dream", "Nixon", "Macy", "Tony", "Kaylani", "Ronnie", "Makayla", "Mathew",
    "Bristol", "Bowen", "Kiara", "Saul", "Pesach", "Kason", "Lorelai", "Cason", "Emory", "Hank",
    "Kensley", "Lionel", "Azariah", "Clay", "Vienna", "Ford", "Coraline", "Lucca", "Reyna", "Niko",
    "Zahra", "Maxton", "Kaliyah", "Alden", "Alanna", "Derrick", "Nyomi", "Joe", "Maleah", "Melvin",
    "Amalia", "Braden", "Penny", "Boston", "Haylee", "Jerome", "Zaylee", "Augustus", "Greta", "Colten",
    "Monroe", "Vihaan", "Charleigh", "Kamari", "Rosa", "Vincenzo", "Zola", "Kody", "Kaydence", "Zyaire",
    "Mylah", "Bodie", "Julie", "Marvin", "Carolina", "Yosef", "Christina", "Layton", "Leona", "Jalen",
    "Milan", "Trenton", "Armani", "Rex", "Kora", "Jovanni", "Amani", "Cannon", "Ariyah", "Danny",
    "Astrid", "Kellen", "Kenley", "Enoch", "Maliyah", "Alonso", "Mikaela", "Brycen", "Jayleen", "Callen",
    "Evie", "Marcos", "Everleigh", "Davion", "Madalyn", "Harry", "Nayeli", "Armando", "Ramona", "Adriano",
    "Hattie", "Arlo", "Avah", "Casey", "Bridget", "Mitchell", "Blakely", "Braylen", "Demi", "Francis",
    "Sasha", "Gage", "Kimber", "Nikolai", "Lillie", "Raiden", "Carly", "Gianni", "Rylie", "Rocco",
    "Royal", "Xzavier", "Aubrielle", "Dominick", "Dorothy", "Jamal", "Emberly", "Memphis", "Emelia", "Atreus",
    "Kyleigh", "Moises", "Sierra", "Issac", "Stevie", "Reece", "Alma", "Roy", "Kairi", "Forrest",
    "Braelyn", "Maximilian", "Danna", "Caiden", "Madalynn", "Raylan", "Perla", "Nasir", "Jayda", "Warren",
    "Karina", "Tadeo", "Miley", "Kingsley", "Martha", "Tadeus", "Charley", "Reginald", "Sariyah", "Desmond",
    "Theodora", "Ermias", "Alison", "Harley", "Hanna", "Mayson", "Angie", "Kareem", "Denise", "Alistair",
    "Navy", "Mauricio", "Casey", "Ishaan", "Caylee", "Ulises", "Emerie", "Finnley", "Johanna", "Brent",
    "Lana", "Imran", "Aleena", "Omari", "Leilany", "Elisha", "Lauryn", "Jaime", "Briar", "Rayden",
    "Giselle", "Yusuf", "Karen", "Jon", "Sabrina", "Arjun", "Destiny", "Aydin", "Yasmin", "Cain",
    "Fernanda", "Dangelo", "Jaliyah", "Konnor", "Annika", "Sincere", "Kendra", "Luciano", "Meredith", "Cassius",
    "Tenley", "Marcellus", "Gloria", "Braydon", "Nia", "Leandro", "Corinne", "Eliseo", "Salma", "Eithan",
    "Teresa", "Thaddeus", "Celeste", "Justus", "Aurelia", "Ronin", "Ryann", "Merrick", "Hadassah", "Bronson",
    "Dayana", "Talon", "Malaysia", "Landry", "Katelyn", "Byron", "Nathaly", "Deandre", "Indigo", "Jerry",
    "Waverly", "Valentino", "Bailee", "Terry", "Jaylin", "Kyson", "Della", "Abdiel", "Kathleen", "Azriel",
    "Scarlette", "Amare", "Sylvia", "Bode", "Nancy", "Giovani", "Denver", "Alistair", "Emmeline", "Davian",
    "Estelle", "Camron", "Livia", "Jabari", "Rayne", "Zahir", "Amora", "Brendon", "Avianna", "Elian",
    "Luz", "Creed", "Leyla", "Krish", "Edith", "Jayceon", "Aliza", "Kolten", "Alena", "Maison",
    "Emmalyn", "Darren", "Estella", "Keenan", "Maia", "Terrance", "Willa", "Watson", "Kallie", "Luka",
    "Farrah", "Jaxxon", "Zaria", "Deacon", "Janelle", "Azariah", "Madisyn", "Harold", "Paulina", "Harper",
    "Frances", "Jamarion", "Halo", "Kylen", "Alondra", "Bowie", "Anahi", "Kendall", "Elianna", "Eliam",
    "Megan", "Junior", "Haley", "Valentin", "Alisha", "Remy", "Tiffany", "Ean", "Kinslee", "Rene",
    "Kynlee", "Kylian", "Alisson", "Makai", "Erin", "Kaiser", "Clarissa", "Darian", "Jessie", "Khari",
    "Meghan", "Osiris", "Saniyah", "Syncere", "Zendaya", "Aidyn", "Jewel", "Davon", "Amirah", "Dilan",
    "Cora", "Kole", "Henley", "Layne", "Aleah", "Lennox", "Janiyah", "Reuben", "Kourtney", "Wesson",
    "Maia", "Zayd", "Avalynn", "Zavier", "Emmie", "Cory", "Kaya", "Fisher", "Liv", "Jacoby",
    "Oaklee", "Osiris", "Sky", "Axl", "Audriana", "Masen", "Brylee", "Stetson", "Ainhoa", "Lachlan",
    "Paloma", "Korbin", "Raya", "Krew", "Journi", "Jermaine", "Zelda", "Wilder", "Jaycee", "Zaid",
    "Laurel", "Bridger", "Kaitlynn", "Vance", "Kamilah", "Castiel", "Kataleya", "Bentlee", "Kenia", "Brodie",
    "Kiana", "Otis", "Lisa", "Jakai", "Rosalee", "Zeke", "Aislinn", "Fox", "Elina", "Niklaus",
    "Emberlynn", "Zain", "Rosalyn", "Ephraim", "Renata", "Brixton", "Whitley", "Dakari", "Amaia", "Ignacio",
    "Yareli", "Sonny", "Cara", "Jedidiah", "Taliyah", "Maximo", "Emmalynn", "Rudy", "Lizbeth", "Ahmir",
    "Treasure", "Blaze", "Aminah", "Caspian", "Jaylee", "Dariel", "Mariam", "Brecken", "Meredith", "Kace",
    "Analia", "Kamden", "Ansley", "Demetrius", "Ayleen", "Eddie", "Barbara", "Rayyan", "Keyla", "Titan",
    "Lilianna", "Arlo", "Tinsley", "Braiden", "Zlata", "Marcel", "Zora", "Yehuda", "Rivka", "Alvaro",
    "Simone", "Ameer", "Lexie", "Decker", "Addilyn", "Jaxx", "Anais", "Matteo", "Brenda", "Brayson",
    "Cassandra", "Eliezer", "Kadence", "Leif", "Kassandra", "Maksim", "Kaylie", "Carsen", "Kyndall", "Roland",
    "Myra", "Agustin", "Noemi", "Shmuel", "Kailee", "Aron", "Meadow", "Jamie", "Carla", "Deegan",
    "Roselyn", "Keanu", "Zainab", "Rohan", "Zayda", "Brantlee", "Abigale", "Santana", "Annalee", "Cannon",
    "Emmaline", "Kenzo", "Jazmine", "Alvin", "Kyra", "Briar", "Lilyana", "Gannon", "Giuliana", "Salvatore",
    "Yaretzi", "Turner", "Elsie", "Xavi", "Kayden", "Yisroel", "Karsyn", "Brice", "Frida", "Kaison",
    "Madilynn", "Coen", "Mckinley", "Dominik", "Marisol", "Isiah", "Jessie", "Jagger", "Kaylin", "Yahir",
    "Kyndal", "Azrael", "Miya", "Joziah", "Mira", "Baylor", "Nola", "Jairo", "Zaniyah", "Odin",
    "Adley", "Jeremias", "Cynthia", "Clyde", "Hana", "Ernesto", "Jemma", "Crosby", "Hensley", "Dominik",
    "Joelle", "Alaric", "Keily", "Jamir", "Nathalia", "Amos", "Sariah", "Mercer", "Yamileth", "Sheldon",
    "Zion", "Truett", "Aiyana", "Wayne", "Bexley", "Cartier", "Ensley", "Elijah", "Ivanna", "Terrence",
    "Leanna", "Alfonso", "Madelynn", "Dario", "Paisleigh", "Ishaan", "Pyper", "Juelz", "Hadleigh", "Azael",
    "Jianna", "Maxx", "Kiera", "Brodie", "Kinsleigh", "Jaeden", "Luciana", "Kyan", "Khaleesi", "Maximo",
    "Raquel", "Lyric", "Zaria", "Reyansh", "Alaysia", "Sylas", "Alisson", "Avi", "Annabell", "Benton",
    "Anniston", "Callahan", "Rhea", "Dhruv", "Emani", "Azriel", "Kalani", "Bodhi", "Kenna", "Brenden",
    "Simone", "Cormac", "Keilani", "Draven", "Amariah", "Jamir", "Dalary", "Leroy", "Natasha", "Ayan",
    "Emilee", "Benton", "Katalina", "Boone", "Marianna", "Ledger", "Sarahi", "Arian", "Brittany", "Benicio",
    "Belinda", "Bruno", "Hayley", "Coen", "Katalina", "Dominik", "Laylah", "Fletcher", "Malaya", "Jayvion",
    "Bria", "Kamdyn", "Rayna", "Cain", "Shayla", "Chaim", "Karter", "Eliam", "Kori", "Kyree",
    "Lillianna", "Ira", "Harleigh", "Karsen", "Nola", "Kody", "Kailani", "Hakeem", "Aspyn", "Jayvion",
    "Emmarie", "Kamryn", "Galilea", "Leighton", "Kenia", "Mike", "Kira", "Mordechai", "Makenna", "Samir",
    "Mckinlee", "Zev", "Neriah", "Calum", "Rylan", "Kelvin", "Tru", "Zechariah",  "Samir",
    "Mckinlee", "Zev", "Neriah", "Calum", "Rylan", "Kelvin", "Tru", "Zechariah",
    "Zaylen", "Emory", "Kylo", "Emelia", "Aziel", "Emberly", "Harlan", "Kamiyah", "Jericho", "Lorelei"
  ];

  const data = {
    Variable1: names, // Using our large dataset of names
    Variable2: [], // Will be populated from API
    Amount: [100, 2500],
    Content: '[Variable1] from [Variable2] just earned $[Amount].'
  };

  // Track swipe state
  let swipeData = {
    startX: 0,
    currentX: 0,
    isDragging: false,
    currentNotification: null
  };

  // Fetch countries from REST Countries API
  async function fetchCountries() {
    try {
      const response = await fetch('https://restcountries.com/v3.1/all?fields=name,capital');
      const countries = await response.json();
      
      // Extract capitals and major cities
      const cities = [];
      countries.forEach(country => {
        if (country.capital && country.capital.length > 0) {
          cities.push(country.capital[0]);
        }
      });
      
      // Add some major cities that might not be capitals
      const additionalCities = [
        "New York", "Los Angeles", "Chicago", "Houston", "Toronto", 
        "Sydney", "Melbourne", "Mumbai", "Shanghai", "São Paulo",
        "Rio de Janeiro", "Istanbul", "Dubai", "Hong Kong", "Singapore"
      ];
      
      data.Variable2 = [...cities, ...additionalCities];
    } catch (error) {
      console.error('Error fetching countries:', error);
      // Fallback to a default list if API fails
      data.Variable2 = [
        "Bangkok", "London", "Paris", "Dubai", "New York", "Singapore",
        "Tokyo", "Seoul", "Barcelona", "Amsterdam", "Berlin", "Rome",
        "Madrid", "Vienna", "Moscow", "Toronto", "Sydney", "Istanbul",
        "Mumbai", "Cairo", "Rio de Janeiro", "Cape Town", "Mexico City"
      ];
    }
  }

  // Function to get random item from array
  function getRandomItem(array) {
    return array[Math.floor(Math.random() * array.length)];
  }

  // Function to get random amount between min and max
  function getRandomAmount(min, max) {
    return Math.floor(Math.random() * (max - min + 1) + min);
  }

  // Function to generate notification message
  function generateMessage() {
    let message = data.Content;
    
    // Replace variables with random values
    const name = getRandomItem(data.Variable1);
    const city = getRandomItem(data.Variable2);
    const minAmount = Math.min(...data.Amount);
    const maxAmount = Math.max(...data.Amount);
    const amount = getRandomAmount(minAmount, maxAmount);
    
    // Format the amount with commas
    const formattedAmount = amount.toLocaleString();
    
    // Replace placeholders with actual values
    message = message.replace('[Variable1]', name);
    message = message.replace('[Variable2]', city);
    message = message.replace('[Amount]', formattedAmount);
    
    return {
      name,
      city,
      amount: formattedAmount,
      message
    };
  }

  // Function to create and show notification
  function showNotification() {
    const container = document.getElementById('notification-container');
    const notificationData = generateMessage();
    
    // Create notification element
    const notification = document.createElement('div');
    notification.className = 'notification';
    
    // Create notification content
    notification.innerHTML = `
      <div class="notification-icon">$</div>
      <div class="notification-content">
        <div class="notification-title">Earnings</div>
        <div class="notification-message">${notificationData.message}</div>
        <div class="notification-time">Just now</div>
      </div>
    `;
    
    // Add to container
    container.appendChild(notification);
    
    // Add event listeners for swipe
    notification.addEventListener('mousedown', handleDragStart);
    notification.addEventListener('touchstart', handleTouchStart);
    notification.addEventListener('mousemove', handleDragMove);
    // notification.addEventListener('touchmove', handleTouchMove);
    notification.addEventListener('mouseup', handleDragEnd);
    notification.addEventListener('touchend', handleDragEnd);
    notification.addEventListener('mouseleave', handleDragEnd);
    
    // Trigger animation (delayed to allow DOM to update)
    setTimeout(() => {
      notification.classList.add('show');
    }, 100);
    
    // Remove notification after delay if not swiped away
    setTimeout(() => {
      if (notification.parentNode) {
        notification.classList.remove('show');
        notification.classList.add('hide');
        
        // Remove from DOM after animation completes
        setTimeout(() => {
          if (notification.parentNode) {
            notification.remove();
          }
        }, 1500); // Match the transition duration
      }
    }, 4000); // 10 seconds display time
  }

  // Handle drag/swipe start
  function handleDragStart(e) {
    if (e.type === 'mousedown') {
      swipeData.startX = e.clientX;
    }
    swipeData.isDragging = true;
    swipeData.currentNotification = this;
    this.classList.add('swiping');
  }

  // Handle touch start
  function handleTouchStart(e) {
    swipeData.startX = e.touches[0].clientX;
    swipeData.isDragging = true;
    swipeData.currentNotification = this;
    this.classList.add('swiping');
  }

  // Handle drag move
  function handleDragMove(e) {
    if (!swipeData.isDragging) return;
    
    const currentX = e.type === 'mousemove' ? e.clientX : e.touches[0].clientX;
    const deltaX = currentX - swipeData.startX;
    
    // Only allow right swipe (positive deltaX)
    if (deltaX > 0) {
      swipeData.currentNotification.style.transform = `translateX(${deltaX}px)`;
    }
  }

  // Handle drag end
  function handleDragEnd(e) {
    if (!swipeData.isDragging) return;
    
    const notification = swipeData.currentNotification;
    notification.classList.remove('swiping');
    
    // Get the current transform value
    const style = window.getComputedStyle(notification);
    const matrix = new WebKitCSSMatrix(style.transform);
    const currentX = matrix.m41;
    
    // If swiped far enough, dismiss the notification
    if (currentX > 50) {
      notification.style.transition = 'transform 0.5s ease';
      notification.style.transform = 'translateX(120%)';
      
      setTimeout(() => {
        notification.remove();
      }, 500);
    } else {
      // Otherwise, snap back
      notification.style.transition = 'transform 0.5s ease';
      notification.style.transform = 'translateX(0)';
      
      setTimeout(() => {
        notification.style.transition = '';
      }, 500);
    }
    
    swipeData.isDragging = false;
    swipeData.currentNotification = null;
  }

  // Initialize
  async function init() {
    await fetchCountries();
    
    // Show first notification after a short delay
    setTimeout(() => {
      showNotification();
      
      // Set interval to show new notifications every 5 seconds
      setInterval(showNotification, 20000);
    }, 20000);
  }

  // Start the app
  init();
 </script>