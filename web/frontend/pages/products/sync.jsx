import { useState } from "react";
import {
  Button,
  Page,
  Layout
} from "@shopify/polaris";
import { Toast } from "@shopify/app-bridge-react";
import { useTranslation } from "react-i18next";
import { useAuthenticatedFetch } from "../../hooks";

export default function Sync() {
  const emptyToastProps = { content: null };
  const [isLoading, setIsLoading] = useState(true);
  const [toastProps, setToastProps] = useState(emptyToastProps);
  const { t } = useTranslation();
  const fetch = useAuthenticatedFetch();

  const toastMarkup = toastProps.content && (
    <Toast {...toastProps} onDismiss={() => setToastProps(emptyToastProps)} />
  );

  const handlePopulate = async () => {
    setIsLoading(true);
    const response = await fetch("/api/products/sync");

    if (response.ok) {
      setToastProps({
        content: t("Product.productsSyncToast"),
      });
    } else {
      setIsLoading(false);
      setToastProps({
        content: t("Product.errorSyncProductsToast"),
        error: true,
      });
    }
  };

  return (
    <>
      {toastMarkup}
      <Page fullWidth>
        <Layout>
          <Layout.Section>
            <Button onClick={handlePopulate}>{ t("Product.sync") }</Button>
          </Layout.Section>
        </Layout>
      </Page>
    </>
  );
}
