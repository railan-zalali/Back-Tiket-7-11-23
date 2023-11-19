export default function ButtonNav({
    className = "",
    disabled,
    children,
    ...props
}) {
    return (
        <button
            {...props}
            className={
                `btn btn-ghost btn-circle ${disabled && "opacity-25"} ` +
                className
            }
            disabled={disabled}
        >
            {children}
        </button>
    );
}
