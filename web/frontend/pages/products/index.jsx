import { useState } from "react";
import {
  Page,
  DataTable,
  Button,
  TextStyle,
  Pagination
} from "@shopify/polaris";
import { TitleBar, Toast, useNavigate } from "@shopify/app-bridge-react";
import { useTranslation } from "react-i18next";
import { useAppQuery } from "../../hooks";

export default function index() {
  const navigate = useNavigate();
  const emptyToastProps = { content: null };
  const [isLoading, setIsLoading] = useState(true);
  const [toastProps, setToastProps] = useState(emptyToastProps);
  const itemsPerPage = 15; // Number of items to show per page
  const [currentPage, setCurrentPage] = useState(1);
  const { t } = useTranslation();
  const headings = ['Product', '', 'Actions'];

  // Calculate the index range for the current page
  const startIndex = (currentPage - 1) * itemsPerPage;
  const endIndex = startIndex + itemsPerPage;

  const {
    data,
    refetch: refetchProductProduct,
    isLoading: isLoadingProduct,
    isRefetching: isRefetchingProduct,
  } = useAppQuery({
    url: "/api/products",
    reactQueryOptions: {
      onSuccess: () => {
        setIsLoading(false);
      },
    },
  });

  // Get the products to display on the current page
  const paginatedProducts = !isLoadingProduct && data.data.slice(startIndex, endIndex);

  const toastMarkup = toastProps.content && !isRefetchingCount && (
    <Toast {...toastProps} onDismiss={() => setToastProps(emptyToastProps)} />
  );

  const handleEditProduct = (productId) => {
    // Handle edit product logic here
  };

  const handleDeleteProduct = (productId) => {
    // Handle delete product logic here
  };


  const breadcrumbs = [{ content: "Home", url: "/" }];
  
  const rows = !isLoadingProduct && paginatedProducts.map((product) => {
    const variantRows = product.variants.map((variant) => [
      variant.id,
      <TextStyle variation="subdued" key={`${variant.id}-title`}>
        {variant.title}
      </TextStyle>,
      variant.price,
      variant.sku,
      variant.inventory_quantity,
    ]);

    return [
      product.title,
      <DataTable
        verticalAlign="middle"
        columnContentTypes={['numeric', 'text', 'numeric', 'numeric', 'numeric']}
        headings={['ID', 'Variant', 'Price', 'Sku', 'Quantity']}
        rows={variantRows}
        key={product.id}
      />,
      <div>
        <Button onClick={() => handleEditProduct(product.id)}>Edit</Button>
        <Button destructive onClick={() => handleDeleteProduct(product.id)}>Delete</Button>
      </div>,
    ];
  });

  const handlePageChange = (newPage) => {
    setCurrentPage(newPage);
  };

  return (
    <>
      {toastMarkup}
      <Page title="Products List">
        <TitleBar
          title="Products"
          breadcrumbs={breadcrumbs}
          primaryAction={null}
        />
        <Button primary onClick={() => {
          navigate('/products/add');
        }}>
          Create New Product
        </Button>
        { !isLoadingProduct && 
          <>
           <DataTable
              columnContentTypes={['text', 'text']}
              headings={headings}
              rows={rows}
            />
            <div style={{ marginTop: '1rem', display: 'flex', justifyContent: 'center' }}>
              <Pagination
                label={`${startIndex + 1}-${Math.min(endIndex, data.data.length)} of ${data.data.length}`}
                hasPrevious={currentPage > 1}
                hasNext={endIndex < data.data.length}
                onPrevious={() => handlePageChange(currentPage - 1)}
                onNext={() => handlePageChange(currentPage + 1)}
              />
            </div>
          </>
        }
      </Page>
    </>
  );
}
