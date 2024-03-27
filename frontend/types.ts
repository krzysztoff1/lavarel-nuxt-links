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
  pubDate: string;
  category: string[];
}[];
