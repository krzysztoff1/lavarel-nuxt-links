interface FormatDateProps {
  readonly date: string;
  readonly locale: string;
}

export const formatDate = ({ date, locale }: FormatDateProps): string => {
  return new Date(date).toLocaleDateString(locale, {
    year: "numeric",
    month: "long",
    day: "numeric",
  });
};
