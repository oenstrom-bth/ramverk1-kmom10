SET NAMES utf8;

USE olen16;

DROP TABLE IF EXISTS r1_PostTag;
DROP TABLE IF EXISTS r1_Comment;
DROP TABLE IF EXISTS r1_Tag;
DROP TABLE IF EXISTS r1_Post;
DROP TABLE IF EXISTS r1_User;


CREATE TABLE r1_User (
    `id` 		INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,
    `role`		VARCHAR(20) NOT NULL DEFAULT 'user',
    `username`	VARCHAR(80) UNIQUE NOT NULL,
    `email`		VARCHAR(255) UNIQUE NOT NULL,
    `password`	VARCHAR(255) NOT NULL,
    `created`	TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `deleted`	DATETIME
) ENGINE INNODB CHARACTER SET utf8 COLLATE utf8_swedish_ci;


INSERT INTO r1_User(role, username, email, password) VALUES
('admin', 'admin', 'olof.enstrom@gmail.com', '$2y$10$Njbsb6l8TCLdvHUcS/65IOcEVARQGICBYqDqx8843aPgpVdlYedrC'),
('user', 'doe', 'mos@dbwebb.se', '$2y$10$26KgRWjs3F654.yHpsYYDO4sd86ksNN1E8zpQ2yHMA/yx33tV/ACq'),
('user', 'aurora', 'nhdandersson@gmail.com', '$2y$10$26KgRWjs3F654.yHpsYYDO4sd86ksNN1E8zpQ2yHMA/yx33tV/ACq'),
('user', 'skvist', 'niso16@student.bth.se', '$2y$10$26KgRWjs3F654.yHpsYYDO4sd86ksNN1E8zpQ2yHMA/yx33tV/ACq'),
('user', 'marcusgsta', 'marcusgu@hotmail.com', '$2y$10$26KgRWjs3F654.yHpsYYDO4sd86ksNN1E8zpQ2yHMA/yx33tV/ACq'),
('user', 'ptorn', 'peder.tornberg@gmail.com', '$2y$10$26KgRWjs3F654.yHpsYYDO4sd86ksNN1E8zpQ2yHMA/yx33tV/ACq'),
('user', 'bredsjomagnus', 'magnusandersson076@gmail.com', '$2y$10$26KgRWjs3F654.yHpsYYDO4sd86ksNN1E8zpQ2yHMA/yx33tV/ACq');

CREATE TABLE r1_Post (
    `id` 		INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,
    `userId`	INTEGER NOT NULL,
    `type`		VARCHAR(50) NOT NULL DEFAULT 'question',
    `parent`	INTEGER NULL,
    `title`		VARCHAR(255) NOT NULL,
    `content`	TEXT,
    `created`	TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated`	DATETIME,
    `deleted`	DATETIME,
    
    FOREIGN KEY (userId) REFERENCES `r1_User` (id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (parent) REFERENCES `r1_Post` (id) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE INNODB CHARACTER SET utf8 COLLATE utf8_swedish_ci;

INSERT INTO r1_Post (userId, title, content) VALUES
(3, 'This is question 01', 'Här kommer lite text, detta är alltså en fråga. Hur mycket text ska man skriva här då? Inte vet jag, men jag tror det räcker snart.\n# Heading 1\n## Heading 2\n### Heading 3\n#### Heading 4\n##### Heading 5\n###### Heading 6\nMaybe so'),
(1, 'This is question 02', '# Is this a question? \n Maybe so'),
(4, 'This is question 03', '# Is this a question? \n Maybe so'),
(1, 'This is question 04', '# Is this a question? \n Maybe so'),
(5, 'This is question 05', '# Is this a question? \n Maybe so'),
(1, 'This is question 06', '# Is this a question? \n Maybe so'),
(6, 'This is question 07', '# Is this a question? \n Maybe so'),
(2, 'This is question 08', '# Is this a question? \n Maybe so'),
(7, 'This is question 09', '# Is this a question? \n Maybe so'),
(1, 'This is question 10', '# Is this a question? \n Maybe so'),
(3, 'This is question 11', '# Is this a question? \n Maybe so'),
(1, 'This is question 12', '# Is this a question? \n Maybe so'),
(6, 'This is question 13', '# Is this a question? \n Maybe so'),
(7, 'This is question 14', '# Is this a question? \n Maybe so'),
(5, 'This is question 15', '# Is this a question? \n Maybe so'),
(1, 'This is question 16', '# Is this a question? \n Maybe so'),
(4, 'This is question 17', '# Is this a question? \n Maybe so'),
(2, 'This is question 18', '# Is this a question? \n Maybe so'),
(1, 'This is question 19', '# Is this a question? \n Maybe so'),
(6, 'This is question 20', '# Is this a question? \n Maybe so'),
(7, 'This is question 21', '# Is this a question? \n Maybe so'),
(2, 'This is question 22', '# Is this a question? \n Maybe so'),
(1, 'This is question 23', '# Is this a question? \n Maybe so'),
(5, 'This is question 24', '# Is this a question? \n Maybe so'),
(1, 'This is question 25', '# Is this a question? \n Maybe so'),
(3, 'This is question 26', '# Is this a question? \n Maybe so'),
(4, 'This is question 27', '# Is this a question? \n Maybe so'),
(6, 'This is question 28', '# Is this a question? \n Maybe so'),
(7, 'This is question 29', '# Is this a question? \n Maybe so'),
(5, 'This is question 30', '# Is this a question? \n Maybe so');



INSERT INTO r1_Post (userId, `type`, parent, title, content) VALUES
(1, 'answer', 1, 'This is question 01', 'This is answer 1 to question 01. idwa iajwdiajd iadwadw ijawd ijwd aijwd awd'),
(4, 'answer', 1, 'This is question 01', 'This is answer 2 to question 01. djiaw wda w wjiaijd iawa ia ia jia ja jia j'),
(6, 'answer', 2, 'This is question 02', 'This is an answer to a question. djiaw wda w wjiaijd iawa ia ia jia ja jia j'),
(3, 'answer', 3, 'This is question 03', 'This is an answer to a question. djiaw wda w wjiaijd iawa ia ia jia ja jia j'),
(7, 'answer', 4, 'This is question 04', 'This is an answer to a question. djiaw wda w wjiaijd iawa ia ia jia ja jia j'),
(2, 'answer', 5, 'This is question 05', 'This is an answer to a question. djiaw wda w wjiaijd iawa ia ia jia ja jia j'),
(1, 'answer', 6, 'This is question 06', 'This is an answer to a question. djiaw wda w wjiaijd iawa ia ia jia ja jia j'),
(1, 'answer', 7, 'This is question 07', 'This is an answer to a question. djiaw wda w wjiaijd iawa ia ia jia ja jia j');


CREATE TABLE r1_Comment (
    `id` 		INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,
    `postId`	INTEGER NOT NULL,
    `userId`	INTEGER NOT NULL,
    `content`	TEXT,
    `created`	TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated`	DATETIME,
    `deleted`	DATETIME,
    
    FOREIGN KEY (`postId`) REFERENCES `r1_Post` (id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (`userId`) REFERENCES `r1_User` (id) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE INNODB CHARACTER SET utf8 COLLATE utf8_swedish_ci;

INSERT INTO r1_Comment (postId, userId, content) VALUES
(1, 2, 'Detta är en fin liten kommentar. Hur mår alla idag? `awdawd` awdwdw awdaw `awd awda adw`'),
(1, 1, 'Detta är en till liten kommentar. `awd https://google.com` <p>hej</p>oiawjdiajwdoiawiod? A link: https://google.com'),
(32, 1, 'Detta är kommentar 1 på answer 2 på question 01. `awd https://google.com` <p>hej</p>oiawjdiajwdoiawiod? A link: https://google.com');


CREATE TABLE r1_Tag (
    `id` 			INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,
    `tag`			VARCHAR(35) UNIQUE,
    `description`	TEXT,
    `created`		TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `deleted`		DATETIME
) ENGINE INNODB CHARACTER SET utf8 COLLATE utf8_swedish_ci;

INSERT INTO r1_Tag (tag, description) VALUES
('javascript', 'JavaScript, often abbreviated as JS, is a high-level, dynamic, weakly typed, prototype-based, multi-paradigm, and interpreted programming language. Alongside HTML and CSS, JavaScript is one of the three core technologies of World Wide Web content production. It is used to make webpages interactive and provide online programs, including video games.'),
('jquery', 'jQuery is a cross-platform JavaScript library designed to simplify the client-side scripting of HTML. It is free, open-source software using the permissive MIT License. Web analysis indicates that it is the most widely deployed JavaScript library by a large margin. jQuery\'s syntax is designed to make it easier to navigate a document, select DOM elements, create animations, handle events, and develop Ajax applications.'),
('html', 'Hypertext Markup Language (HTML) is the standard markup language for creating web pages and web applications. With Cascading Style Sheets (CSS) and JavaScript it forms a triad of cornerstone technologies for the World Wide Web. Web browsers receive HTML documents from a web server or from local storage and render them into multimedia web pages. HTML describes the structure of a web page semantically and originally included cues for the appearance of the document.'),
('css', 'Cascading Style Sheets (CSS) is a style sheet language used for describing the presentation of a document written in a markup language. Although most often used to set the visual style of web pages and user interfaces written in HTML and XHTML, the language can be applied to any XML document, including plain XML, SVG and XUL, and is applicable to rendering in speech, or on other media.'),
('php', 'PHP is a server-side scripting language designed primarily for web development but also used as a general-purpose programming language. Originally created by Rasmus Lerdorf in 1994, the PHP reference implementation is now produced by The PHP Development Team. PHP originally stood for Personal Home Page, but it now stands for the recursive acronym PHP: Hypertext Preprocessor.'),
('python', 'Python is a widely used high-level programming language for general-purpose programming, created by Guido van Rossum and first released in 1991. An interpreted language, Python has a design philosophy that emphasizes code readability (notably using whitespace indentation to delimit code blocks rather than curly brackets or keywords), and a syntax that allows programmers to express concepts in fewer lines of code than might be used in languages such as C++ or Java.'),
('nodejs', 'Node.js is an open-source, cross-platform JavaScript run-time environment for executing JavaScript code server-side. Historically, JavaScript was used primarily for client-side scripting, in which scripts written in JavaScript are embedded in a webpage\s HTML, to be run client-side by a JavaScript engine in the user\s web browser. Node.js enables JavaScript to be used for server-side scripting, and runs scripts server-side to produce dynamic web page content before the page is sent to the user\'s web browser.'),
('less', 'Less is a dynamic style sheet language that can be compiled into Cascading Style Sheets (CSS) and run on the client side or server side. Designed by Alexis Sellier, Less is influenced by Sass and has influenced the newer "SCSS" syntax of Sass, which adapted its CSS-like block formatting syntax. Less is open source. Its first version was written in Ruby; however, in the later versions, use of Ruby has been deprecated and replaced by JavaScript.'),
('sass', 'Sass (syntactically awesome stylesheets) is a style sheet language initially designed by Hampton Catlin and developed by Natalie Weizenbaum. After its initial versions, Weizenbaum and Chris Eppstein continued to extend Sass with SassScript, a simple scripting language used in Sass files. Sass is a scripting language that is interpreted or compiled into Cascading Style Sheets (CSS). SassScript is the scripting language itself.');


CREATE TABLE r1_PostTag (
	`id`		INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,
    `postId` 	INTEGER NOT NULL,
    `tagId`		INTEGER NOT NULL,
    
    FOREIGN KEY (`postId`) REFERENCES `r1_Post` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (`tagId`) REFERENCES `r1_Tag` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE INNODB CHARACTER SET utf8 COLLATE utf8_swedish_ci;

INSERT INTO r1_PostTag (postId, tagId) VALUES
(1, 1), (1, 2),
(2, 4);