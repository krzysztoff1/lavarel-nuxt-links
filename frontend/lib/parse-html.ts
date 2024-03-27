export const parseHtml = (html: string) => {
  const htmlTagsRegex = /<[^>]*>/g;
  const bracketsRegex = /\[&#[0-9]*;\]/g;

  return html.replace(htmlTagsRegex, "").replace(bracketsRegex, "");
};
