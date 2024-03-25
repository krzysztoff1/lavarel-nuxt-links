// - ArticleList: Array[{ guid, title, pubDate, category }]
// - Article: { guid, title, link, description, category }

// export type Article = {
//   title: string;
//   link: string;
//   comments: string;
//   pubDate: string;
//   category: string[];
//   guid: string;
//   description: string;
// };

export type Article = {
  guid: string;
  title: string;
  link: string;
  description: string;
  category: string[];
};

export type ArticleList = {
  guid: string;
  title: string;
  link: string;
  pubDate: string;
  category: string[];
}[];
