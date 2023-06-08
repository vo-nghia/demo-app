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
  const [status, setStatus] = useState('');
  const [toastProps, setToastProps] = useState(emptyToastProps);

  const handleTitleChange = useCallback((value) => setTitle(value), []);
  const handleDescribodyHtmlChange = useCallback((value) => setDescribodyHtml(value), []);
  const handleVendorChange = useCallback((value) => setVendor(value), []);
  const handleProductTypeChange = useCallback((value) => setProductType(value), []);
  const handleStatusChange = useCallback((value) => setStatus(value), []);

  const toastMarkup = toastProps.content && (
    <Toast {...toastProps} onDismiss={() => setToastProps(emptyToastProps)} />
  );

  const {
    data,
    refetch: refetchSingleProduct,
    isLoading: isLoadingSingleProduct,
    isRefetching: isRefetchingSingleProduct,
  } = useAppQuery({
    url: `/api/products/${id}`,
    reactQueryOptions: {
      onSuccess: () => {
        setIsLoading(false);
      },
    },
  });

  // initial product data

  const handleEdit = async () => {
    setIsLoading(true);

    // update new data to shopify and database
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
