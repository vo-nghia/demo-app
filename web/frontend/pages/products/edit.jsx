import {
  Page,
  AlphaCard 
} from "@shopify/polaris";
import { TitleBar } from "@shopify/app-bridge-react";
import { useTranslation, Trans } from "react-i18next";

export default function HomePage() {
  const { t } = useTranslation();
  return (
    <Page narrowWidth>
      <TitleBar title={t("Product.edit")} primaryAction={null} />
      <Page title="Polaris Demo Page">
        <AlphaCard  sectioned title="Hello World"></AlphaCard >
      </Page>
    </Page>
  );
}
