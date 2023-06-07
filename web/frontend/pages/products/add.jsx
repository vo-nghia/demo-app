import { useState, useCallback } from "react";
import {
  Page,
  TextField,
  FormLayout,
  Button,
  Form
} from "@shopify/polaris";
import { TitleBar } from "@shopify/app-bridge-react";
import { useTranslation } from "react-i18next";
import { useAuthenticatedFetch } from "../../hooks";
import { Toast } from "@shopify/app-bridge-react";

export default function HomePage() {
  const emptyToastProps = { content: null };
  const [isLoading, setIsLoading] = useState(true);
  const { t } = useTranslation();
  const [title, setTitle] = useState('');
  const [describody_html, setDescribodyHtml] = useState('');
  const [vendor, setVendor] = useState('');
  const [product_type, setProductType] = useState('');
  const [status, setStatus] = useState('');
  const fetch = useAuthenticatedFetch();
  const [toastProps, setToastProps] = useState(emptyToastProps);

  const handleSubmit = async () => {
    setIsLoading(true);
    const response = await fetch("/api/products/create");

    if (response.ok) {
      setToastProps({
        content: t("Product.created"),
      });
    } else {
      setIsLoading(false);
      setToastProps({
        content: t("ProductsCard.errorCreatingProductsToast"),
        error: true,
      });
    }
  };

  const handleTitleChange = useCallback((value) => setTitle(value), []);
  const handleDescribodyHtmlChange = useCallback((value) => setDescribodyHtml(value), []);
  const handleVendorChange = useCallback((value) => setVendor(value), []);
  const handleProductTypeChange = useCallback((value) => setProductType(value), []);
  const handleStatusChange = useCallback((value) => setStatus(value), []);


  return (
    <Page narrowWidth>
      <TitleBar title={t("Product.add")} primaryAction={null} />
      <Form onSubmit={handleSubmit}>
        <FormLayout>
          <TextField
            label="Title"
            type="text"
            value={title}
            onChange={handleTitleChange}
          />

          <TextField
            label="Describody_html"
            type="text" multiline={4}
            value={describody_html}
            onChange={handleDescribodyHtmlChange}
          />

          <TextField
            label="vendor"
            type="text"
            value={vendor}
            onChange={handleVendorChange}
          />

          <TextField
            label="product_type"
            type="text"
            value={product_type}
            onChange={handleProductTypeChange}
          />

          <TextField
            label="status"
            type="text"
            value={status}
            onChange={handleStatusChange}
          />

          <Button submit>Submit</Button>
        </FormLayout>
      </Form>
    </Page>
  );
}
