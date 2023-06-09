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
import { useAuthenticatedFetch, useAppQuery } from "../../../hooks";
import { Toast } from "@shopify/app-bridge-react";
import { useParams } from "react-router-dom";
import { useState, useCallback, useEffect } from "react";

export default function Edit() {
  const { t } = useTranslation();
  const { id } = useParams();
  const navigate = useNavigate();
  const emptyToastProps = { content: null };
  const [isLoading, setIsLoading] = useState(true);
  const [title, setTitle] = useState('');
  const [describody_html, setDescribodyHtml] = useState('');
  const [vendor, setVendor] = useState('');
  const [product_type, setProductType] = useState('');
  const [tags, setTags] = useState('');
  const [toastProps, setToastProps] = useState(emptyToastProps);

  const handleTitleChange = useCallback((value) => setTitle(value), []);
  const handleDescribodyHtmlChange = useCallback((value) => setDescribodyHtml(value), []);
  const handleVendorChange = useCallback((value) => setVendor(value), []);
  const handleProductTypeChange = useCallback((value) => setProductType(value), []);
  const handleTagsChange = useCallback((value) => setTags(value), []);

  const toastMarkup = toastProps.content && (
    <Toast {...toastProps} onDismiss={() => setToastProps(emptyToastProps)} />
  );

  // initial product data
  useEffect(() => {
    setIsLoading(true);
    fetchData();
  }, []);

  const fetchData = async () => {
    try {
      const response = await fetch(`/api/products/${id}`);
      const jsonData = await response.json();
      const productDetail = jsonData.data;
      setTitle(productDetail.title);
      setDescribodyHtml(productDetail.body_html);
      setVendor(productDetail.vendor);
      setProductType(productDetail.product_type);
      setTags(productDetail.tags);
    } catch (e) {
      console.log(e);
    }

    setIsLoading(false);
  };

  const handleEdit = async () => {
    setIsLoading(true);

    fetch('/api/token')
      .then(response => response.json())
      .then(data => {
        const headers = {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': data.token
        };

        fetch(`/api/products/${id}`, {
          method: 'PUT',
          headers: headers,
          body: JSON.stringify({
            title: title,
            body_html: describody_html,
            vendor: vendor,
            product_type: product_type,
            tags: tags
          })
        })
          .then(response => {
            setToastProps({
              content: t("Product.edited"),
            });
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

  return (
    <>
      {toastMarkup}
      <Page narrowWidth>
        <TitleBar title={t("Product.edit")} primaryAction={null} />
        <Layout.Section>
          <Form onSubmit={handleEdit} method="post">
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
                label="Vendor"
                type="text"
                value={vendor}
                onChange={handleVendorChange}
              />

              <TextField
                label="Product Type"
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
                <Button submit primary>Edit</Button>
                <Button onClick={() => {navigate('/products');}}>Back to list</Button>
              </ButtonGroup>
            </FormLayout>
          </Form>
        </Layout.Section>
      </Page>
    </>
  );
}
