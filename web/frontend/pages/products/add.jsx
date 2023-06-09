import { useState, useCallback } from "react";
import {
  Page,
  TextField,
  FormLayout,
  Button,
  Form,
  Layout,
  ButtonGroup
} from "@shopify/polaris";
import { TitleBar, useNavigate } from "@shopify/app-bridge-react";
import { useTranslation } from "react-i18next";
import { useAuthenticatedFetch } from "../../hooks";
import { Toast } from "@shopify/app-bridge-react";

export default function Add() {
  const navigate = useNavigate();
  const emptyToastProps = { content: null };
  const [isLoading, setIsLoading] = useState(true);
  const { t } = useTranslation();
  const [title, setTitle] = useState('');
  const [describody_html, setDescribodyHtml] = useState('');
  const [vendor, setVendor] = useState('');
  const [product_type, setProductType] = useState('');
  const [tags, setTags] = useState('');
  const fetch = useAuthenticatedFetch();
  const [toastProps, setToastProps] = useState(emptyToastProps);

  const handleSubmit = async () => {
    setIsLoading(true);

    fetch('/api/token')
      .then(response => response.json())
      .then(data => {
        const headers = {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': data.token
        };

        fetch('/api/products/create', {
          method: 'POST',
          headers: headers,
          body: JSON.stringify({
            title: title,
            body_html: describody_html,
            vendor: vendor,
            product_type: product_type,
            tags: tags,
          })
        })
          .then(response => {
            setToastProps({
              content: t("Product.created"),
            });
            setTitle('');
            setDescribodyHtml('');
            setVendor('');
            setProductType('');
            setTags('');
          })
          .catch(error => {
            setIsLoading(false);
            setToastProps({
              content: error,
              error: true,
            });
          });
      })
      .catch(error => {
        setIsLoading(false);
        setToastProps({
          content: error,
          error: true,
        });
      });
  };

  const toastMarkup = toastProps.content && (
    <Toast {...toastProps} onDismiss={() => setToastProps(emptyToastProps)} />
  );

  const handleTitleChange = useCallback((value) => setTitle(value), []);
  const handleDescribodyHtmlChange = useCallback((value) => setDescribodyHtml(value), []);
  const handleVendorChange = useCallback((value) => setVendor(value), []);
  const handleProductTypeChange = useCallback((value) => setProductType(value), []);
  const handleTagsChange = useCallback((value) => setTags(value), []);

  return (
    <>
      {toastMarkup}
      <Page narrowWidth>
        <TitleBar title={t("Product.add")} primaryAction={null} />
        <Layout.Section>
          <Form onSubmit={handleSubmit} method="post">
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
                label="Tags"
                type="text"
                value={tags}
                onChange={handleTagsChange}
              />

              <ButtonGroup>
                <Button submit primary>Register</Button>
                <Button onClick={() => {navigate('/products');}}>Back to list</Button>
              </ButtonGroup>
            </FormLayout>
          </Form>
        </Layout.Section>
      </Page>
    </>
  );
}
