import {
  Page,
  Layout,
  TextField
} from "@shopify/polaris";
import { TitleBar } from "@shopify/app-bridge-react";
import { useTranslation, Trans } from "react-i18next";


export default function Welcome() {
  const { t } = useTranslation();
  return (
    <Page narrowWidth>
      <TitleBar title={t("Welcome.title")} primaryAction={null} />
      <Layout>
        <Layout.Section>
            <TextField
              role="combobox"
              label={"Start date"}
              value={"Vo Van Nghia"}
              onFocus={() => setVisible(true)}
              autoComplete="off"
            />
        </Layout.Section>
      </Layout>
    </Page>
  );
}
